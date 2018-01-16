# Base image
FROM mysql:5.7

# Copy starting scripts file
COPY start.sh /root/start.sh

# Run necessary services
CMD ["/bin/bash", "/root/start.sh"]

RUN cd /etc/mysql/conf.d && ls
RUN cd /etc/mysql/conf.d/source && ls