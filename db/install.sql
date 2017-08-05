CREATE TABLE feeds (
    id VARCHAR(32) NOT NULL PRIMARY KEY,
    enabled TINYINT(1) DEFAULT 1
);

CREATE TABLE keys (
    id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
    public_key VARCHAR(64) NOT NULL UNIQUE,
    private_key VARCHAR(64) NOT NULL
);