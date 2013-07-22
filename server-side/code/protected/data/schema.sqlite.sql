CREATE TABLE tbl_user (
    id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
    level VARCHAR(32),
    username VARCHAR(32) UNIQUE,
    password VARCHAR(32),
    salt VARCHAR(32),
    udid VARCHAR(128) NOT NULL UNIQUE,
    model VARCHAR(128) NOT NULL,
    time BIGINT NOT NULL,
    expire BIGINT
);

CREATE TABLE tbl_door (
    id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
    name VARCHAR(128) NOT NULL,
    opened_by VARCHAR(32),
    opened_at BIGINT
);

INSERT INTO tbl_user 
    (level, username, password, salt, udid, model, time, expire) VALUES 
    ('admin', 'zhangshenjia', 'pass', 'salt', 'udid', 'model', 1368631371, 1369631371);
    
INSERT INTO tbl_user 
    (level, username, password, salt, udid, model, time, expire) VALUES 
    ('admin', 'liuguowei', 'pass', 'salt', 'udidd', 'model', 1368631371, 1369631371);

    
INSERT INTO tbl_door 
    (name) VALUES
    ('openlab');