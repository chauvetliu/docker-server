# PHP7.4 Dockerfile
# chauvetliu@163.com
# 2021-08-01

ARG PHP74_PATH
ARG PHP74_VERSION

#镜像信息
FROM php:${PHP74_VERSION}-fpm

LABEL author="chauvetliu@163.com"

#更改docker源
#COPY sources.list /etc/apt/sources.list

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

# rm -rf /var/lib/apt/lists/* 主要是减少最终镜像的大小。通常是可以减少21M以上。
# 参考 https://docs.docker.com/develop/develop-images/dockerfile_best-practices/#general-guidelines-and-recommendations

#运行命令构建
RUN apt-get update \
    && apt-get install -y libpng-dev \
    && apt-get install -y libfreetype6-dev \
    && apt-get install -y libjpeg62-turbo-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && apt-get install -y --no-install-recommends \
				ca-certificates \
				wget \
				dpkg-dev \
				gcc \
				libc6-dev \
				libssl-dev \
				make \
	; \
    \
    echo "安装Redis 扩展"; \
	wget -P /tmp ${REDIS_ZEND_EXTENSION_DOWNLOAD_URL}; \
    tar zxvf /tmp/redis-${REDIS_EXT_VERSION}.tgz -C /tmp; \
    cd /tmp && mv package.xml redis-${REDIS_EXT_VERSION}; \
    rm -r /tmp/redis-${REDIS_EXT_VERSION}.tgz; \
    cd /tmp/redis-${REDIS_EXT_VERSION}; \ 
    phpize && ./configure && make && make install; \
    cd ${ZEND_EXTENSION_INI} && touch docker-php-ext-redis.ini; \
    echo "extension=redis.so">${ZEND_EXTENSION_INI}/docker-php-ext-redis.ini


    
#   rm -rf /var/lib/apt/lists/*;

#EXPOSE 9000
#CMD ["php-fpm"]
















# RUN apt-get update  && apt-get install -y \
#         git \
#         autoconf \
#         dpkg-dev \
#         file \
#         g++ \
#         gcc \
#         libc-dev \
#         make \
#         pkg-config \
#         re2c \
#         ca-certificates \
#         curl \
#         xz-utils \
#         --no-install-recommends \
#         pkg-config \
#         build-essential \
#         zlib1g-dev \
#         libmcrypt-dev \
#         libcurl4-openssl-dev \
#         libedit-dev \
#         libsodium-dev \
#         libsqlite3-dev \
#         libssl-dev \
#         libxml2-dev \
#         libtidy-dev \
#         libxslt1-dev \
#         libfreetype6-dev \
#         libjpeg62-turbo-dev \
#         libpng-dev \
#         libicu-dev \
#         libmemcached-dev \
#         libxslt-dev \
#         libldap2-dev \
#         libbz2-dev \
#         libzip-dev \
#         libenchant-dev \
#         libsnmp-dev \
#         snmp \
#         libpspell-dev \
#         freetds-dev \
#     && docker-php-ext-install intl \
#     && docker-php-ext-install zip \
#     && docker-php-ext-install pcntl \
#     && docker-php-ext-install mysqli \
#     && docker-php-ext-install mbstring \
#     && docker-php-ext-install exif \
#     && docker-php-ext-install opcache \
#     && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
#     && docker-php-ext-install -j$(nproc) gd \
#     && docker-php-ext-install soap \
#     && docker-php-ext-install wddx \
#     && docker-php-ext-install xmlrpc \
#     && docker-php-ext-install tidy \
#     && docker-php-ext-install xsl \
#     && docker-php-ext-install xml \
#     && docker-php-ext-configure ldap --with-libdir=lib/x86_64-linux-gnu \
#     && docker-php-ext-install -j$(nproc) ldap \
#     && docker-php-ext-install bz2 \
#     && docker-php-ext-install pdo \
#     && docker-php-ext-install pdo_mysql \
#     && docker-php-ext-install tokenizer \
#     && docker-php-ext-install -j$(nproc) snmp \
#     && docker-php-ext-install -j$(nproc) pspell \
#     && docker-php-ext-install -j$(nproc) enchant \
#     && docker-php-ext-configure pdo_dblib --with-libdir=lib/x86_64-linux-gnu \
#     && docker-php-ext-install -j$(nproc) pdo_dblib

#    && echo "清理缓存" \
#    && rm -rf /var/cache/apt/* \
#    && rm -rf /var/lib/apt/lists/*
    

#    && pecl install mcrypt-1.0.1 \
#    && docker-php-ext-enable mcrypt \

#    && pecl install redis-4.0.1 \
#    && docker-php-ext-enable redis \

#    && pecl install memcached \
#    && docker-php-ext-enable memcached \

#    && docker-php-ext-configure opcache --enable-opcache \
#    && docker-php-ext-install opcache

#    && echo "安装redis扩展" \
#    && curl -L -o /tmp/redis-${PHP_REDIS}.tar.gz http://download.redis.io/releases/redis-${PHP_REDIS}.tar.gz \
#    && tar xfz /tmp/redis-${PHP_REDIS}.tar.gz \
#    && mv package.xml redis-${PHP_REDIS} \
#    && rm -r /tmp/redis-${PHP_REDIS}.tar.gz \
#    && cd redis-${PHP_REDIS} \
#    && phpize && ./configure && make && make install \
#    && echo "extension=redis.so">${PHP73_PATH}/redis.ini \

#    && echo "安装mongodb扩展" \
#    && curl -L -o /tmp/mongodb-${PHP74_MONGODB}.tgz http://pecl.php.net/get/mongodb-${PHP74_MONGODB}.tgz \
#    && tar xfz /tmp/mongodb-${PHP74_MONGODB}.tgz \
#    && mv package.xml mongodb-${PHP74_MONGODB} \
#    && rm -r /tmp/mongodb-${PHP74_MONGODB}.tgz \
#    && cd mongodb-${PHP74_MONGODB} \
#    && phpize && ./configure && make && make install \
#    && echo "extension=mongodb.so">${PHP74_PATH}/mongodb.ini \


