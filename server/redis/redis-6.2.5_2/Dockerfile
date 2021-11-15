# Redis Dockerfile
# chauvetliu@163.com
# 2021-08-19

ARG REDIS_PATH
ARG REDIS_VERSION

#FROM ubuntu:18.04
FROM debian:buster-slim

LABEL author="chauvetliu@163.com"

ENV REDIS_VERSION 6.2.5
ENV REDIS_PACKAGE_PATH ./package/
ENV REDIS_DOWNLOAD_URL http://download.redis.io/releases/redis-${REDIS_VERSION}.tar.gz
ENV REDIS_DOWNLOAD_SHA 4b9a75709a1b74b3785e20a6c158cab94cf52298aa381eea947a678a60d551ae

#创建用户权限
RUN groupadd -r -g 999 redis && useradd -r -g redis -u 999 redis

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
	rm -rf /var/lib/apt/lists/*; \
	\
	echo "下载Redis， $REDIS_DOWNLOAD_SHA *redis.tar.gz" | sha256sum -c -; \
	wget -O redis.tar.gz "$REDIS_DOWNLOAD_URL"; \
	mkdir -p /usr/src/redis/redis-${REDIS_VERSION}; \
	tar -xzf redis.tar.gz -C /usr/src/redis/redis-${REDIS_VERSION} --strip-components=1; \
	rm redis.tar.gz \
	; \
	ls -l /usr/src/redis; \
	echo "创建目录开始编译"; \
	cd /usr/src/redis/redis-${REDIS_VERSION} && make && make install \
	&& ln -s /usr/local/redis/bin/* /usr/local/bin/ \
	&& rm -rf /usr/src/redis/redis-${REDIS_VERSION}

#创建目录和权限
RUN mkdir /var/log/redis
RUN cd /var/log/redis && touch redis.log
RUN mkdir /data && chown redis:redis /data
VOLUME /data
WORKDIR /data


#映射端口
EXPOSE 6379

#执行启动命令加载配置文件
CMD ["redis-server"]