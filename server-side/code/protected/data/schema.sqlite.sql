CREATE TABLE tbl_user (
    id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
    level VARCHAR(32),
    username VARCHAR(32) UNIQUE,
    password VARCHAR(32),
    salt VARCHAR(32),
    token VARCHAR(128) NOT NULL UNIQUE,
    time BIGINT NOT NULL,
    expire BIGINT
);

CREATE TABLE tbl_door (
    id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
    name VARCHAR(128) NOT NULL,
    opened_at BIGINT
);

INSERT INTO tbl_user 
    (level, username, password, salt, token, time, expire) VALUES 
    ('admin', 'zhangshenjia', 'pass', 'salt', 'token', 1368631371, 1369631371);
    
INSERT INTO tbl_door 
    (name) VALUES
    ('openlab');