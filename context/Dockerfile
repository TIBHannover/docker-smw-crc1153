######################################
# docker-smw-crc1153                 #
######################################

ARG OPENRESEARCH_STACK=0.0.26
FROM ghcr.io/gesinn-it-pub/openresearch-stack:${OPENRESEARCH_STACK}

# LocalSettings.Custom.php
#ADD LocalSettings.Custom.php /var/www/html/

# Global styles
#COPY mediawiki-global-styles/styles/* /var/www/html/resources/src/mediawiki.gesinn-it.global.styles/

#COPY media /var/www/html/_custom/media
#COPY styles /var/www/html/_custom/styles

######################################
# run as http://localhost:8080		 #
######################################
ENV WIKI_DOMAIN=localhost
ENV WIKI_PORT=8080

######################################
# set smw-crc1153 version     		 #
######################################
ARG SMW-CRC1153_VERSION=2.0.0-alpha1
RUN echo $SMW-CRC1153_VERSION > smw-crc1153-version.txt && \
    echo "\$wgSmwCrc1153Version = '$SMW-CRC1153_VERSION';" >> LocalSettings.Include.php
