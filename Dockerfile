FROM mattrayner/lamp:latest-1804

RUN apt update
RUN apt install -y php7.4-intl php7.4 php7.4-mbstring

CMD ["/run.sh"]
