CREATE TABLE door_user (
    id integer not null primary key auto_increment,
    level varchar(32) not null,
    username varchar(32),
    password varchar(32),
    salt varchar(32) not null,
    token varchar(128) not null,
    time bigint not null,
    expire bigint not null
);

INSERT INTO door_user 
    (level, username, password, salt, token, time, expire) VALUES 
    ('admin', 'zhangshenjia', 'pass', 'salt', 'token', 1368631371, 1369631371);