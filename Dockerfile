FROM bitnami/wordpress:latest
USER root

COPY wp-content/mu-plugins/ /opt/bitnami/wordpress/wp-content/mu-plugins/
COPY entrypoint-extra.sh /entrypoint-extra.sh
RUN chmod +x /entrypoint-extra.sh \
    && chown -R 1001:1001 /opt/bitnami/wordpress/wp-content

USER 1001
ENTRYPOINT ["/entrypoint-extra.sh"]
CMD ["/opt/bitnami/scripts/wordpress/run.sh"]
