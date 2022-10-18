FROM mysql:8.0.30-debian

RUN apt-get update \
    && apt-get install -y locales \
    && sed -i -E 's/# (ja_JP.UTF-8)/\1/' /etc/locale.gen \
    && locale-gen \
    && update-locale LANG=ja_JP.UTF-8 \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

COPY ./infra/docker/mysql/my.cnf /etc/my.cnf

ENV LC_ALL ja_JP.UTF-8

USER mysql