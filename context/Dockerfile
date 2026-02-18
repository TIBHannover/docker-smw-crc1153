######################################
# docker-smw-crc1153                 #
######################################

ARG OPENRESEARCH_STACK=1.39.15-010
FROM ghcr.io/tibhannover/openresearch-stack:${OPENRESEARCH_STACK}

RUN \
	### install required apt packages
	#
	# graphviz 1)
	#
	# 1) External_Data Graphviz
	#
	apt-get update && \
	apt-get install -y graphviz && \
	rm -rf /var/lib/apt/lists/*

USER www-data
RUN \
    ### ConfirmAccount
    # last version that supports 1.39
    # TODO: This is already part of OR-Stack but with a different version!
    # get-github-extension.sh ConfirmAccount 5c8c0ca2fc0fd27d2388b407de7f7a7fac6e9e9b wikimedia/mediawiki-extensions-ConfirmAccount && \
    #
    #
    ### EditAccount (2025-02-20)
    get-github-extension.sh EditAccount 4bc14fa01ae997a492a7189a061218834188f231 gesinn-it-pub/EditAccount && \
    #
    #
    ### KnowledgeGraph (2026-01-20)
    get-github-extension.sh KnowledgeGraph 3.0.2 SemanticMediaWiki/KnowledgeGraph

RUN composer-update.sh
USER root

######################################
# add SMW-CRC1153 settings           #
######################################
ADD --chown=www-data:www-data LocalSettings.Include.php /var/www/html/.
ADD --chown=www-data:www-data LocalSettings.SMW1153 /var/www/html/LocalSettings.SMW1153

# Global styles
#COPY mediawiki-global-styles/styles/* /var/www/html/resources/src/mediawiki.gesinn-it.global.styles/

#COPY media /var/www/html/_custom/media
#COPY styles /var/www/html/_custom/styles
######################################
# add style files                    #
######################################
# COPY --chown=www-data:www-data mediawiki-global-styles/styles/* /var/www/html/resources/src/mediawiki.gesinn-it.global.styles/
COPY --chown=www-data:www-data media /var/www/html/resources/src/mediawiki.smw1153.media/
COPY --chown=www-data:www-data styles/* /var/www/html/resources/src/mediawiki.smw1153.styles/

######################################
# run as http://localhost:8080		 #
######################################
ENV WIKI_DOMAIN=localhost
ENV WIKI_PORT=8080

######################################
# set smw-crc1153 version     		 #
######################################
ARG SMW-CRC1153_VERSION=2.0.0-beta19
RUN echo $SMW-CRC1153_VERSION > smw-crc1153-version.txt && \
    echo "\$wgSmwCrc1153Version = '$SMW-CRC1153_VERSION';" >> LocalSettings.Include.php
