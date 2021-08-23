# NGINX Dockerfile
# chauvetliu@163.com
# 2021-08-04

ARG NGINX_VERSION
ARG NGINX_HTML

#镜像信息
FROM nginx:${NGINX_VERSION}

#提前安装一些功能
RUN apt-get update \
	&& apt-get install -y curl \
    && apt-get install -y net-tools \
    && apt-get install -y procps \
    && apt-get install -y inetutils-ping \
    && apt-get install -y telnet \
    && apt-get install -y --no-install-recommends \
				ca-certificates \
				wget \
				dpkg-dev \
				gcc \
				libc6-dev \
				libssl-dev \
				make \
	; \
	rm -rf /var/lib/apt/lists/*;