#
# NGINX Dockerfile
# chauvetliu@163.com
#

# 多阶段构建
# 阶段 1：基础镜像选择，builder 阶段：安装 JDK、Maven 和时区配置。
# 使用官方 OpenJDK 8 镜像（Alpine Linux 精简版，体积小）
FROM openjdk:8-jdk-alpine as builder

# 设置时区
RUN apk add --no-cache tzdata && \
    cp /usr/share/zoneinfo/Asia/Shanghai /etc/localtime && \
    echo "Asia/Shanghai" > /etc/timezone

# 设置字符集
ENV LANG C.UTF-8
ENV LANGUAGE en_US:en
ENV LC_ALL C.UTF-8

# 安装构建工具（Maven）
RUN apk add --no-cache maven


# 阶段 2：项目构建阶段，build-stage 阶段：编译项目并生成 JAR 文件。
FROM builder as build-stage

# 创建工作目录
WORKDIR /app

# 复制项目文件
#COPY pom.xml .
#COPY src ./src

# 下载依赖
RUN mvn dependency:go-offline -B

# 编译项目（生成 JAR 包）
RUN mvn package -DskipTests


# 阶段 3：最终运行阶段，从 build-stage 复制 JAR 文件，并生成最终的运行镜像。
FROM openjdk:8-jre-alpine

# 设置非 root 用户
RUN addgroup -S appgroup && adduser -S appuser -G appgroup
USER appuser

# 从构建阶段复制 JAR 文件
COPY --from=build-stage /app/target/*.jar /app/app.jar

# 设置工作目录
WORKDIR /app

# 暴露端口
EXPOSE 8888

# 启动命令
ENTRYPOINT ["java", "-jar", "app.jar"]