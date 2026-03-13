FROM bitnami/wordpress:latest
USER root

COPY braidsinboras/wp-content/mu-plugins/ /opt/bitnami/wordpress/wp-content/mu-plugins/

RUN chown -R 1001:1001 /opt/bitnami/wordpress/wp-content

USER 1001
