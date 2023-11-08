
.PHONY: start
start:
	docker-compose up -d --build application_prod
	chmod +x ./scripts/*
	./scripts/init-environment.sh
	./scripts/openBrowser.sh

.PHONY: devup
devup:
	docker-compose up -d --build application_dev
	chmod +x ./scripts/*
	./scripts/init-environment.sh
	./scripts/openBrowser.sh

.PHONY: down
down:
	docker-compose down

.PHONY: build
build:
	docker-compose build
