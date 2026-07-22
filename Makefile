
# Resolve the GitHub token from a per-identity env var derived from the
# local git identity (e.g. "alexander-gesinn" -> GH_TOKEN_ALEXANDER_GESINN),
# falling back to GH_API_TOKEN for contributors who haven't migrated yet.
GH_USER := $(shell git config user.name)
GH_TOKEN_VAR := GH_TOKEN_$(shell echo $(GH_USER) | tr '[:lower:]-' '[:upper:]_')
GH_TOKEN := $(or $($(GH_TOKEN_VAR)),$(GH_API_TOKEN))
.PHONY: all
all:

compose = docker compose $(COMPOSE_ARGS)
compose-run = $(compose) run --rm
compose-exec = $(compose) exec -T
compose-cp = docker compose cp
wiki-exec = $(compose-exec) wiki

# ======== Build ========

.PHONY: build
build:
	$(compose) build

# ======== Develop ========

.PHONY: bash
bash:
	$(compose) exec wiki bash

# ======== Run ========

.PHONY: sqlite-up
sqlite-up:
	$(compose) up -d

.PHONY: mysql-up up
mysql-up up:
	MYSQL_HOST=mysql $(compose) --profile mysql up -d

.PHONY: wait-for-wiki
wait-for-wiki:
	$(compose-run) wait-for-wiki

.PHONY: show-status
show-status:
	$(compose) ps

.PHONY: show-logs
show-logs:
	$(compose) logs -f || exit 0

.PHONY: stop
stop:
	$(compose) stop

.PHONY: down
down:
	$(compose) down

.PHONY: destroy
destroy:
	$(compose) down --volumes --remove-orphans

# ======== Backstop ========

backstop = $(compose-run) backstop --config backstop.config.js

.PHONY: backstop-test
backstop-test: wait-for-wiki
	$(backstop) test

.PHONY: backstop-approve
backstop-approve:
	$(backstop) approve

# ======== Backup ========

backup = $(compose) pull backup && $(compose-run) backup

.PHONY: create-backup
create-backup: wait-for-wiki
	$(backup) create

.PHONY: restore-backup
restore-backup: wait-for-wiki
	$(backup) restore

# ======== CI ========

.PHONY: ci
ci: down build
	$(MAKE) with-ci destroy mysql-up disable-opcache restore-backup backstop-test
	$(MAKE) with-ci destroy
	$(eval COMPOSE_ARGS = )

.PHONY: with-ci
with-ci:
	$(eval COMPOSE_ARGS = -p docker-smw-crc1153-ci)

.PHONY: disable-opcache
disable-opcache:
	$(wiki-exec) disable-opcache.sh

# ======== Release ========

VERSION = `sed -n -e 's/^ARG CONFIDENT_VERSION=//p' ./context/Dockerfile`

.PHONY: release
release: ci git-push gh-login
	gh release create $(VERSION)

.PHONY: git-push
git-push:
	git diff --quiet || (echo 'git directory has changes'; exit 1)
	git fetch # make sure we have access to the repository
	git push

.PHONY: gh-login
gh-login: require-GH_TOKEN
	gh config set prompt disabled
	@echo $(GH_TOKEN) | gh auth login --with-token

.PHONY: require-GH_TOKEN
require-GH_TOKEN:
ifndef GH_TOKEN
	$(error No GitHub token found. Set $(GH_TOKEN_VAR) (derived from git config user.name "$(GH_USER)") or GH_API_TOKEN as a fallback.)
endif
