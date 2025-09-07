# Docker Server 服务项目

## 项目简介

本项目提供一个基于 Docker Compose 的 Docker 服务部署解决方案，帮助开发者快速构建和部署分布式服务环境以及测试环境。通过规范的目录结构和预配置的 `docker-compose.yml` 文件，用户可以轻松地启动和管理多个服务，如数据库、Web 服务器、消息队列等。

## 项目特点

- **快速部署**：通过 Docker Compose 一键启动多个服务，简化了复杂的部署流程。
- **目录规范**：项目目录结构清晰，便于管理和维护。
- **多服务支持**：支持多种常用服务，如 MySQL、Redis、Nginx、MongoDB 等，满足不同场景的需求。
- **灵活配置**：用户可以根据需要自定义 `docker-compose.yml` 文件，灵活调整服务配置。
- **日志管理**：所有服务的运行日志统一存放在 `logs` 目录，便于排查问题。

## 项目目录结构

```
.
├── data                  # 存放各种数据集，例如 Redis 的 .dump 文件
├── htdocs                # 适用于 Apache 用户惯用的根目录
├── logs                  # 服务运行日志
├── other                 # 其他文件
├── packages              # 各种包文件
├── server                # 要在 Docker 中搭建的各种服务
│   ├── golang            # Golang 服务
│   ├── mongodb           # MongoDB 服务
│   ├── mysql             # MySQL 服务
│   ├── nginx             # Nginx 服务
│   ├── php               # PHP 服务
│   ├── python            # Python 服务
│   ├── rabbitmq          # RabbitMQ 服务
│   └── redis             # Redis 服务
├── shell                 # 编写的 Shell 脚本
├── wwwroot               # 适用于 Nginx 等用户惯用的根目录
├── README.md             # 项目说明文件
└── docker-compose.yml    # Docker Compose 配置文件
```

## 快速开始

### 1. 克隆项目

首先，将项目克隆到本地：

```bash
git clone https://github.com/chauvetliu/docker-server.git
cd docker-server
```

### 2. 启动服务

使用 Docker Compose 启动所有服务：

```bash
# 如果您使用的是 Docker Compose V1（带连字符版本）
docker-compose up -d

# 如果您使用的是 Docker Compose V2（插件版本，使用空格）
docker compose up -d
```

### 3. 停止服务

停止所有服务：

```bash
# Docker Compose V1
docker-compose down

# Docker Compose V2  
docker compose down
```

### 4. 查看日志

所有服务的日志都存放在 `logs` 目录下，可以通过以下命令查看实时日志：

```bash
tail -f logs/*.log
```

## 服务配置

### MySQL

MySQL 服务的配置文件位于 `server/mysql` 目录下。你可以根据需要修改 `my.cnf` 文件。

### Redis

Redis 服务的配置文件位于 `server/redis` 目录下。你可以根据需要修改 `redis.conf` 文件。

### Nginx

Nginx 服务的配置文件位于 `server/nginx` 目录下。你可以根据需要修改 `nginx.conf` 文件。

### 其他服务

其他服务的配置文件也分别位于对应的目录下，用户可以根据需要进行自定义配置。

## 自定义服务

如果你需要添加新的服务，可以在 `server` 目录下创建一个新的文件夹，并在 `docker-compose.yml` 文件中添加相应的配置。例如，添加一个 PostgreSQL 服务：

```yaml
services:
  postgres:
    image: postgres:latest
    container_name: postgres
    environment:
      POSTGRES_USER: user
      POSTGRES_PASSWORD: password
    volumes:
      - ./server/postgres/data:/var/lib/postgresql/data
    ports:
      - "5432:5432"
```

## Docker Compose 版本说明

本项目支持 Docker Compose 的两种命令格式：

1. **Docker Compose V1**（传统版本）：使用 `docker-compose` 命令（带连字符）
2. **Docker Compose V2**（新版插件）：使用 `docker compose` 命令（空格）

### 版本检查

要确定您系统上安装的 Docker Compose 版本，可以运行以下命令：

```bash
# 检查 V1 版本
docker-compose --version

# 检查 V2 版本  
docker compose version
```

### 兼容性说明

- 如果您使用的是 **Docker Desktop**（Windows/Mac），默认已安装 V2 版本
- 如果您在 **Linux** 上手动安装，可能需要额外安装 `docker-compose-plugin` 来获得 V2 版本
- V1 版本目前已弃用，建议使用 V2 版本以获得最新功能和持续支持

## 说明

Docker Compose V2.x 版本使用了最新的特性和改进，提供了更好的性能和兼容性。建议用户优先使用 V2 版本的命令格式。

## 贡献

欢迎贡献代码和提出建议！请通过 GitHub 提交 Pull Request 或 Issue。

## 作者信息

**作者**: Chauvetliu  
**联系邮箱**: chauvetliu@163.com  

如果您有任何问题或建议，请随时通过上述邮箱与我联系。期待您的反馈和支持！

## 许可证

本项目采用 [MIT 许可证](LICENSE)。

---

通过本项目，你可以快速搭建一个完整的开发或测试环境，节省大量时间和精力。希望这个项目能帮助你更高效地进行开发和部署！