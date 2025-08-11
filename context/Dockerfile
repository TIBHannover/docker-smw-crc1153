######################################
# docker-smw-crc1153                 #
######################################

ARG OPENRESEARCH_STACK=1.39.13-002
FROM ghcr.io/tibhannover/openresearch-stack:${OPENRESEARCH_STACK}

USER www-data
RUN \
    #
    #
    ### ConfirmAccount (REL1_39 2029-08-04)
    get-github-extension.sh ConfirmAccount 680e5399a102eed4f287e4561d8b5bcdda74350c wikimedia/mediawiki-extensions-ConfirmAccount && \
    #
    #
    ### EditAccount (2025-02-20)
    get-github-extension.sh EditAccount 4bc14fa01ae997a492a7189a061218834188f231 gesinn-it-pub/EditAccount && \
    #
    #
    # get-github-extension.sh CodeMirror 268f838a9c176ef4655b2e2637a81b17963e16c6 wikimedia/mediawiki-extensions-CodeMirror && \
    # RUN get-github-extension.sh WSSlots 9a39063a848130030c35944dea047386315051ae Open-CSP/WSSlots && \
    # RUN get-github-extension.sh InteractiveSemanticGraph 701ca84916e58b15a106dbbbd2ca41f48397b15d OpenSemanticLab/mediawiki-extensions-InteractiveSemanticGraph && \
    #
    ### KnowledgeGraph
    # get-github-extension.sh KnowledgeGraph 0fef81f5c70cb5ad6165d0bd22bb973eac06b44e gesinn-it-ilm/KnowledgeGraph 
    get-github-extension.sh KnowledgeGraph 93e7618c92b0e132dbc8644d28401c652b566a03 SemanticMediaWiki/KnowledgeGraph

RUN composer-update.sh
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
ARG SMW-CRC1153_VERSION=2.0.0-beta2
RUN echo $SMW-CRC1153_VERSION > smw-crc1153-version.txt && \
    echo "\$wgSmwCrc1153Version = '$SMW-CRC1153_VERSION';" >> LocalSettings.Include.php
