USE exeamonitor;

CREATE TABLE checks (
    created datetime not null default now(),
    pos_id int(10) not null,
    state varchar(15),
    volume numeric(5),
    current_song varchar(50),
    INDEX (created, pos_id)
)
PARTITION BY RANGE( DATE(created) ) (
    PARTITION jan VALUES LESS THAN ('2020-02-01'),
    PARTITION feb VALUES LESS THAN ('2020-03-01'),
    PARTITION mar VALUES LESS THAN ('2020-04-01'),
    PARTITION apr VALUES LESS THAN ('2020-05-01'),
    PARTITION may VALUES LESS THAN ('2020-06-01'),
    PARTITION jun VALUES LESS THAN ('2020-07-01'),
    PARTITION jul VALUES LESS THAN ('2020-08-01'),
    PARTITION aug VALUES LESS THAN ('2020-09-01'),
    PARTITION sep VALUES LESS THAN ('2020-10-01'),
    PARTITION oct VALUES LESS THAN ('2020-11-01'),
    PARTITION nov VALUES LESS THAN ('2020-12-01'),
    PARTITION dic VALUES LESS THAN MAXVALUE
);