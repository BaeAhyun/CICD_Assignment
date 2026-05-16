# CI/CD Assignment - PHP Web App

PHP 기반 회원관리 웹 애플리케이션을 Docker로 패키징하고, GitHub Actions를 통해 Docker Hub에 자동 배포되는 CI/CD 파이프라인 구성 과제입니다.

## 프로젝트 설명

회원 가입, 로그인, 관리자 페이지(회원 목록 조회/삭제) 기능을 포함하는 간단한 PHP 웹 애플리케이션입니다. PDO를 사용하여 MySQL 데이터베이스와 연동하며, Docker Compose를 통해 PHP 앱 컨테이너와 MySQL 컨테이너를 함께 실행할 수 있습니다.

## 사용 기술

- **Backend**: PHP 8.2 (PDO, pdo_mysql)
- **Frontend**: HTML, CSS, JavaScript
- **Database**: MySQL 8.0
- **Containerization**: Docker, Docker Compose
- **CI/CD**: GitHub Actions
- **Image Registry**: Docker Hub

## 프로젝트 구조
.
├── .github/
│   └── workflows/
│       └── docker-image.yml    # GitHub Actions workflow
├── .dockerignore
├── .gitignore
├── Dockerfile                  # PHP 앱 컨테이너 정의
├── docker-compose.yml          # PHP + MySQL 통합 실행
├── init.sql                    # DB 초기화 스크립트
├── db.php                      # DB 연결 (PDO)
├── register.html / .js         # 회원가입 페이지
├── register_process.php        # 회원가입 처리
├── login.html / .js            # 로그인 페이지
├── login_check.php             # 로그인 검증
├── admin_users.php             # 회원 목록 관리자 페이지
├── delete_user.php             # 회원 삭제 처리
└── index.css                   # 공통 스타일

## Docker Hub 이미지

**Repository**: https://hub.docker.com/r/baeahyun/cicd-assignment

**Pull 명령**:

```bash
docker pull baeahyun/cicd-assignment:latest
```

## 로컬 실행 방법

### Docker Compose 사용 (권장)

PHP 앱과 MySQL DB를 함께 실행합니다.

```bash
docker compose up
```

종료:

```bash
docker compose down
```

### 단일 컨테이너 실행 (DB 없이 정적 페이지만)

```bash
docker run -p 8080:8080 baeahyun/cicd-assignment:latest
```

### 접속

브라우저에서 다음 주소로 접속:

- 회원가입: http://localhost:8080/register.html
- 로그인: http://localhost:8080/login.html
- 관리자 페이지: http://localhost:8080/admin_users.php

## CI/CD 파이프라인

`main` 브랜치에 push 또는 pull request가 발생하면 GitHub Actions가 자동으로 실행됩니다.

### Workflow 동작 순서

1. **Checkout repository** — 소스 코드 체크아웃
2. **Log in to Docker Hub** — GitHub Secrets에 저장된 인증 정보로 로그인
3. **Set up Docker Buildx** — 멀티 플랫폼 빌드 환경 준비
4. **Build and push Docker image** — Dockerfile로 이미지 빌드 후 Docker Hub에 push

### 생성되는 이미지 태그

- `baeahyun/cicd-assignment:latest` — 최신 빌드
- `baeahyun/cicd-assignment:<commit-sha>` — 각 commit별 이력 추적용

### Workflow 파일

`.github/workflows/docker-image.yml`

### GitHub Secrets

- `DOCKERHUB_USERNAME` — Docker Hub 사용자명
- `DOCKERHUB_TOKEN` — Docker Hub Personal Access Token

## 환경 변수

`db.php`는 다음 환경 변수를 사용하여 DB에 연결합니다 (Docker Compose에서 자동 주입).

| 변수 | 기본값 | 설명 |
|---|---|---|
| `DB_HOST` | `localhost` | DB 호스트 (Compose 환경에서는 `db`) |
| `DB_NAME` | `my_site` | 데이터베이스 이름 |
| `DB_USER` | `root` | DB 사용자 |
| `DB_PASSWORD` | (빈 값) | DB 비밀번호 |