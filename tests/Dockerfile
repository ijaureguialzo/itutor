FROM php:8.5.12-cli

RUN set -eux; \
    apt-get update; \
    apt-get install -y --no-install-recommends \
        libicu-dev \
        libcurl4-openssl-dev \
    ; \
    docker-php-ext-install curl mysqli; \
    apt-get purge -y --auto-remove -o APT::AutoRemove::Recommends=false -o APT::AutoRemove::Suggests=false; \
    rm -rf /var/lib/apt/lists/*

COPY itutor_test.php /tests/itutor_test.php
COPY lint.sh /tests/lint.sh
COPY run.sh /tests/run.sh
RUN chmod +x /tests/*.sh

CMD ["/tests/run.sh"]
