.PHONY: help
help: makefile
	@tail -n +4 makefile | grep ".PHONY"


.PHONY: serve
serve:
	php -S localhost:8000


.PHONY: format
format:
	nix fmt
