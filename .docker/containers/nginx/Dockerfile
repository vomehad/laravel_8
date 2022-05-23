FROM zedsh/nginx

RUN apk --no-cache add shadow
RUN groupmod -g 1000 nginx
RUN usermod -u 1000 nginx

COPY conf/nginx.conf /etc/nginx/nginx.conf
COPY conf/default.conf /etc/nginx/conf.d/default.conf
#RUN sed -i "s/#DOCUMENT_ROOT#/${DOCUMENT_ROOT}/g" /etc/nginx/conf.d/default.conf
COPY conf/upstream.conf /etc/nginx/conf.d/upstream.conf

EXPOSE 80

STOPSIGNAL SIGTERM

CMD ["nginx", "-g", "daemon off;"]
