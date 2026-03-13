FROM bitnami/wordpress:latest
USER root

COPY wp-content/mu-plugins/ /opt/bitnami/wordpress/wp-content/mu-plugins/
COPY copy-plugins.sh /docker-entrypoint-init.d/copy-plugins.sh
RUN chmod +x /docker-entrypoint-init.d/copy-plugins.sh \
    && chown -R 1001:1001 /opt/bitnami/wordpress/wp-content

USER 1001
