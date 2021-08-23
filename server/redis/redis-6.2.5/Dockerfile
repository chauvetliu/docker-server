# Redis Dockerfile
# chauvetliu@163.com
# 2021-08-19

ARG REDIS_VERSION

#FROM ubuntu:18.04
FROM debian:buster-slim

LABEL author="chauvetliu@163.com"

ENV REDIS_VERSION 6.2.5
ENV REDIS_PACKAGE_PATH ../../../package/
ENV REDIS_DOWNLOAD_URL http://download.redis.io/releases/redis-6.2.5.tar.gz
ENV REDIS_DOWNLOAD_SHA 4b9a75709a1b74b3785e20a6c158cab94cf52298aa381eea947a678a60d551ae

#提前安装一些功能
RUN apt-get update \
    && apt-get install -y curl \
    && apt-get install -y net-tools \
    && apt-get install -y procps \
    && apt-get install -y inetutils-ping \
    && apt-get install -y telnet \
    && apt-get install -y vim \
    && apt-get install -y --no-install-recommends \
		ca-certificates \
		wget \
		dpkg-dev \
		gcc \
		libc6-dev \
		libssl-dev \
		make \
    rm -rf /var/lib/apt/lists/*; \
	\
	echo "$REDIS_DOWNLOAD_SHA *redis.tar.gz" | sha256sum -c -; \
	tar -xzf "$REDIS_DOWNLOAD_URL"redis.tar.gz -C /usr/src/redis --strip-components=1; \
	redis-cli --version; \
	redis-server --version \
	;


#创建目录和权限
RUN mkdir /data && chown redis:redis /data
VOLUME /data
WORKDIR /data

COPY docker-entrypoint.sh /usr/local/bin/
ENTRYPOINT ["docker-entrypoint.sh"]

EXPOSE 6379

#执行启动命令加载配置文件
CMD ["redis-server",,"/usr/local/etc/redis.conf"]