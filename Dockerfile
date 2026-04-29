FROM bitnami/wordpress:latest

USER root
# Copy your local wp-content to the correct internal Bitnami path
COPY wp-content /opt/bitnami/wordpress/wp-content

# Fix ownership so the 'daemon' user (1001) can manage the files
RUN chown -R 1001:1001 /opt/bitnami/wordpress/wp-content
ENV WORDPRESS_SKIP_INSTALL=no
ENV FS_METHOD=direct

# Switch back to the non-root user for security and compatibility
USER 1001
