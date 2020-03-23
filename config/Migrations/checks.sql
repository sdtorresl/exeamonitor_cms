USE exeamonitor;

DROP TABLE checks;
CREATE TABLE checks (
    created datetime not null default now(),
    pos_id int(10) not null,
    state varchar(15),
    volume numeric(5),
    current_song varchar(50),
    INDEX (created, pos_id)
)
PARTITION BY RANGE( MONTH(created) ) (
    PARTITION jan VALUES LESS THAN (2),
    PARTITION feb VALUES LESS THAN (3),
    PARTITION mar VALUES LESS THAN (4),
    PARTITION apr VALUES LESS THAN (5),
    PARTITION may VALUES LESS THAN (6),
    PARTITION jun VALUES LESS THAN (7),
    PARTITION jul VALUES LESS THAN (8),
    PARTITION aug VALUES LESS THAN (9),
    PARTITION sep VALUES LESS THAN (10),
    PARTITION oct VALUES LESS THAN (11),
    PARTITION nov VALUES LESS THAN (12),
    PARTITION dic VALUES LESS THAN MAXVALUE
);