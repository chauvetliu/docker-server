#
# Redis Dockerfile
# chauvetliu@163.com
#

ARG REDIS_VERSION

#FROM ubuntu:18.04
FROM debian:buster-slim

# 设置维护者信息
LABEL author="chauvetliu@163.com"

# 在FROM之后定义的ARG变量可以在FROM之后的所有指令中使用。
ARG REDIS_PATH
ARG REDIS_DOWNLOAD_URL
ARG USE_CUSTOM_APT_SOURCE

# 更改docker源
# 注意：COPY 是一个独立的指令，不能直接嵌套在 RUN 指令中
COPY ./config/sources.list /tmp/sources.list

# 执行cp替换
RUN if [ "$USE_CUSTOM_APT_SOURCE" = "true" ]; then \
        echo "Use custom source.list"; \
        cp /tmp/sources.list /etc/apt/sources.list; \
    else \
        echo "Use default source.list"; \
    fi

ENV REDIS_PACKAGE_PATH ./package/

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
	wget -O redis.tar.gz "${REDIS_DOWNLOAD_URL}"; \
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