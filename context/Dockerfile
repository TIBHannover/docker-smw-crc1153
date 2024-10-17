######################################
# docker-smw-crc1153                 #
######################################

ARG OPENRESEARCH_STACK=1.39.10-001
FROM ghcr.io/tibhannover/openresearch-stack:${OPENRESEARCH_STACK}

RUN get-github-extension.sh KnowledgeGraph 7d9133396e12e7a089a171e33305bc0b6931d7df SemanticMediaWiki/KnowledgeGraph

USER root

######################################
# add SMW-CRC1153 settings        #
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
ARG SMW-CRC1153_VERSION=2.0.0-beta1
RUN echo $SMW-CRC1153_VERSION > smw-crc1153-version.txt && \
    echo "\$wgSmwCrc1153Version = '$SMW-CRC1153_VERSION';" >> LocalSettings.Include.php
