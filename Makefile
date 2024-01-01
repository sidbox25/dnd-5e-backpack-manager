
.PHONY: start
start:
	docker-compose up -d --build application_prod
	docker-compose up -d --build db
	chmod +x ./scripts/*
	./scripts/init-environment.sh
	./scripts/openBrowser.sh

.PHONY: devup
devup:
	docker-compose up -d  application_dev
	docker-compose up -d  db
	docker-compose up -d  adminer
	./scripts/init-environment.sh
	./scripts/openBrowser.sh

.PHONY: down
down:
	docker-compose down

.PHONY: build
build:
	docker-compose build
