#
# PHP7.4 Dockerfile
# author: chauvetliu@163.com
# date: 2021-08-01
#

ARG PHP74_PATH
ARG PHP74_VERSION

#镜像信息
FROM php:${PHP74_VERSION}-fpm

LABEL author="chauvetliu@163.com"

#更改docker源
#COPY sources.list /etc/apt/sources.list

#日志目录
ENV PHP_WEBLOG_PATH=/var/log/php

#设置时区
ENV TIME_ZONE=Asia/Shanghai
RUN ln -snf /usr/share/zoneinfo/$TIME_ZONE /etc/localtime && echo $TIME_ZONE > /etc/timezone

#PHP扩展.so目录
ENV ZEND_EXTENSION_SO=/usr/local/etc/zend_extension

#PHP 添加到conf.d *.ini文件目录
ENV ZEND_EXTENSION_INI=/usr/local/etc/php/conf.d

#Redis PHP扩展下载地址，参考地址：https://pecl.php.net/package/redis
ENV REDIS_EXT_VERSION=5.3.4
ENV REDIS_ZEND_EXTENSION_DOWNLOAD_URL=http://pecl.php.net/get/redis-${REDIS_EXT_VERSION}.tgz

#MongoDB PHP扩展下载地址，参考地址：https://pecl.php.net/package/mongodb
ENV MONGODB_EXT_VERSION=1.10.0
ENV MONGODB_ZEND_EXTENSION_DOWNLOAD_URL=http://pecl.php.net/get/mongodb-${MONGODB_EXT_VERSION}.tgz

#APCU 扩展
ENV APCU_EXT_VERSION=5.1.20
ENV APCU_ZEND_EXTENSION_DOWNLOAD_URL=http://pecl.php.net/get/apcu-${APCU_EXT_VERSION}.tgz

#amqp 扩展(rabbitmq)
ENV AMQP_EXT_NAME=amqp
ENV AMQP_EXT_VERSION=1.10.2
ENV AMQP_ZEND_EXTENSION_DOWNLOAD_URL=http://pecl.php.net/get/amqp-${AMQP_EXT_VERSION}.tgz


# rm -rf /var/lib/apt/lists/* 主要是减少最终镜像的大小。通常是可以减少21M以上。
# 参考 https://docs.docker.com/develop/develop-images/dockerfile_best-practices/#general-guidelines-and-recommendations

#设置 pear 和pecl 的 php_ini 这样系统扩展可以直接添加到php.ini
#pear config-set php_ini /usr/local/etc/php/php.ini
#pecl config-set php_ini /usr/local/etc/php/php.ini

#注意添加数据卷 `volumes` 的问题
#不太适合将所有的PHP文件都由本地数据卷 然后映射到容器中，这样有个问题是当Dockerfile生成新的扩展文件，会被构建成功后的数据卷替换为宿主机的数据卷导致新构建的文件丢失

#USER www-data

#运行命令构建
RUN apt-get update \
    && apt-get install -y curl \
    && apt-get install -y procps \
    && apt-get install -y telnet \
    && apt-get install -y net-tools \
    && apt-get install -y inetutils-ping \
    && apt-get install -y libpng-dev \
    && apt-get install -y libfreetype6-dev \
    && apt-get install -y libjpeg62-turbo-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-install mysqli \
    && docker-php-ext-install exif \
    && docker-php-ext-install pcntl \
    && docker-php-ext-install pdo \
    && docker-php-ext-install bcmath \
    && docker-php-ext-configure opcache --enable-opcache \
    && docker-php-ext-install opcache \
    && apt-get install -y --no-install-recommends \
				ca-certificates \
				wget \
				dpkg-dev \
				gcc \
				libc6-dev \
				libssl-dev \
				make \
                vim \
                apt-utils \
                \
                autoconf \
                file \
                g++ \
                gcc \
                pkg-config \
                xz-utils \
                zlib1g-dev \
                libmcrypt-dev \
                libcurl4-openssl-dev \
                libedit-dev \
                libxml2-dev \
                libtidy-dev \
	; \
    \
    \
    echo "安装Redis 扩展"; \
	wget -P /tmp/redis ${REDIS_ZEND_EXTENSION_DOWNLOAD_URL}; \
    tar zxvf /tmp/redis/redis-${REDIS_EXT_VERSION}.tgz -C /tmp/redis; \
    cd /tmp/redis && mv package.xml redis-${REDIS_EXT_VERSION}; \
    cd /tmp/redis/redis-${REDIS_EXT_VERSION}; \ 
    phpize && ./configure && make && make install; \
    cd ${ZEND_EXTENSION_INI} && touch docker-php-ext-redis.ini; \
    echo "extension=redis.so">${ZEND_EXTENSION_INI}/docker-php-ext-redis.ini; \
    \
    \
    echo "安装mongodb 扩展"; \
	wget -P /tmp/mongodb ${MONGODB_ZEND_EXTENSION_DOWNLOAD_URL}; \
    tar zxvf /tmp/mongodb/mongodb-${MONGODB_EXT_VERSION}.tgz -C /tmp/mongodb; \
    cd /tmp/mongodb && mv package.xml mongodb-${MONGODB_EXT_VERSION}; \
    #rm -r /tmp/mongodb/mongodb-${MONGODB_EXT_VERSION}.tgz; \
    cd /tmp/mongodb/mongodb-${MONGODB_EXT_VERSION}; \ 
    phpize && ./configure && make && make install; \
    cd ${ZEND_EXTENSION_INI} && touch docker-php-ext-mongodb.ini; \
    echo "extension=mongodb.so">${ZEND_EXTENSION_INI}/docker-php-ext-mongodb.ini; \
    \
    \
    echo "安装apcu 扩展"; \
	wget -P /tmp/apcu ${APCU_ZEND_EXTENSION_DOWNLOAD_URL}; \
    tar zxvf /tmp/apcu/apcu-${APCU_EXT_VERSION}.tgz -C /tmp/apcu; \
    cd /tmp/apcu && mv package.xml apcu-${APCU_EXT_VERSION}; \
    #rm -r /tmp/apcu/apcu-${APCU_EXT_VERSION}.tgz; \
    cd /tmp/apcu/apcu-${APCU_EXT_VERSION}; \ 
    phpize && ./configure && make && make install; \
    cd ${ZEND_EXTENSION_INI} && touch docker-php-ext-apcu.ini; \
    echo "extension=apcu.so">${ZEND_EXTENSION_INI}/docker-php-ext-apcu.ini; \
    \
    \
    echo "安装rabbitmq 扩展"; \
    apt-get install -y librabbitmq-dev; \
    apt-get install -y librabbitmq4; \
	wget -P /tmp/${AMQP_EXT_NAME} ${AMQP_ZEND_EXTENSION_DOWNLOAD_URL}; \
    tar zxvf /tmp/${AMQP_EXT_NAME}/${AMQP_EXT_NAME}-${AMQP_EXT_VERSION}.tgz -C /tmp/${AMQP_EXT_NAME}; \
    cd /tmp/${AMQP_EXT_NAME} && mv package.xml ${AMQP_EXT_NAME}-${AMQP_EXT_VERSION}; \
    cd /tmp/${AMQP_EXT_NAME}/${AMQP_EXT_NAME}-${AMQP_EXT_VERSION}; \ 
    phpize && ./configure && make && make install; \
    cd ${ZEND_EXTENSION_INI} && touch docker-php-ext-${AMQP_EXT_NAME}.ini; \
    echo "extension=amqp.so">${ZEND_EXTENSION_INI}/docker-php-ext-${AMQP_EXT_NAME}.ini; \
    \
    \
    echo "清理缓存"; \
    #rm -r /tmp/*; \
    rm -rf /var/lib/apt/lists/*;

    #便携安装PHP扩展（可能会失败）
    # 必须设置 pear 和pecl 的 php_ini 这样使用pecl安装PHP扩展才可以直接添加到php.ini
    # pear config-set php_ini /usr/local/etc/php/php.ini
    # pecl config-set php_ini /usr/local/etc/php/php.ini
    #
    # && pecl install mcrypt-1.0.1 \
    # & docker-php-ext-enable mcrypt \

    # && pecl install redis-4.0.1 \
    # && docker-php-ext-enable redis \

    # && docker-php-ext-configure opcache --enable-opcache \
    # && docker-php-ext-install opcache


#创建和授权目录权限
RUN mkdir -p ${PHP_WEBLOG_PATH} && chown -R www-data:www-data ${PHP_WEBLOG_PATH} && chmod -R 777 ${PHP_WEBLOG_PATH}

#映射端口
EXPOSE 9000

#执行启动命令
#CMD ["php-fpm"]