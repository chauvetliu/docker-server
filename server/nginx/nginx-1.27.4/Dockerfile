#
# NGINX Dockerfile
# chauvetliu@163.com
#

# 因ARG作用域规则，在FROM之前定义的ARG只能在FROM中使用，FROM之后不可使用
# ARG NGINX_VERSION=1.27.4 是给设置默认值如果没有获取到就取默认值
ARG NGINX_VERSION=1.27.4

#镜像信息
FROM nginx:${NGINX_VERSION}

# 设置维护者信息
LABEL author="chauvetliu@163.com"

# 在FROM之后定义的ARG变量可以在FROM之后的所有指令中使用。
ARG NGINX_HTML
ARG USE_CUSTOM_APT_SOURCE

# 打印 ARG 变量的内容
RUN echo "Nginx的html目录为: ${NGINX_HTML}";
RUN echo "Nginx版本为: ${NGINX_VERSION}";
RUN echo "是否自定义源文件: ${USE_CUSTOM_APT_SOURCE}";

# 更改docker源
# 注意：COPY 是一个独立的指令，不能直接嵌套在 RUN 指令中
COPY ./config/sources.list /tmp/sources.list

# 执行cp替换
RUN if [ "$USE_CUSTOM_APT_SOURCE" = "true" ]; then \
        echo "Nginx Use custom source.list"; \
        #备份源文件
        mv /etc/apt/sources.list /etc/apt/sources.list.default; \
        #替换新源
        cp /tmp/sources.list /etc/apt/sources.list; \
    else \
        echo "Use default source.list"; \
    fi

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

EXPOSE 80

CMD ["nginx", "-g", "daemon off;"]
