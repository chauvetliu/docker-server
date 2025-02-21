#
# Golang Dockerfile
# author: chauvetliu@163.com
#


# 导入Go变量
ARG GOLANG_VERSION
ARG LOCALHOST_GOROOT
ARG CONTAINER_GOPATH
ARG LOCALHOST_GOPATH

#设置环境
ENV GOLANG_VERSION ${GOLANG_VERSION}
ENV GOROOT /usr/local/go
ENV GOPROXY https://goproxy.cn,direct
ENV PATH /usr/local/go/bin:$PATH

# 使用官方的 Golang 镜像
FROM golang:${GOLANG_VERSION}

# 设置工作目录（可选）
WORKDIR ${CONTAINER_GOPATH}

# 安装额外的工具（可选）
# 例如：安装 git、curl 等常用工具
RUN apk add --no-cache git curl

# 设置环境变量（可选）
ENV GOPATH /go
ENV PATH $GOPATH/bin:$PATH

# 保持容器运行（用于调试或开发）
CMD ["tail", "-f", "/dev/null"]