FROM nginx:1.20-alpine

ARG GROUP_ID ${GROUP_ID} \
    GROUP_NAME ${GROUP_NAME} \
    USER_ID ${USER_ID} \
    USER_NAME ${USER_NAME}

RUN addgroup -S --g $GROUP_ID $GROUP_NAME \
  && adduser -u $USER_ID -G $USER_NAME -D $USER_NAME \
  && adduser $USER_NAME $GROUP_NAME \
  && chown -R $USER_NAME:$GROUP_NAME /var/cache/nginx \
  && chmod -R g+w /var/cache/nginx \
  && chown -R nginx:nginx /etc/nginx/conf.d

COPY ./infra/docker/nginx/nginx.conf /etc/nginx/nginx.conf
COPY ./infra/docker/nginx/conf.d/default.conf /etc/nginx/conf.d/default.conf

USER $USER_NAME

WORKDIR /var/www/backend