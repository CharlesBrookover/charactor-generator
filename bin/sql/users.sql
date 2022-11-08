create table users
(
    email     TEXT not null unique,
    firstName TEXT not null,
    lastName  TEXT not null,
    handle    TEXT,
    siteKey   TEXT not null,
    created   INTEGER default CURRENT_TIMESTAMP,
    updated   INTEGER
);

create table users_auth
(
    email         TEXT    not null unique,
    password      TEXT    not null,
    -- Fake a BOOLEAN/BIT column
    googleOAuth   INTEGER not null default 0 check (googleOAuth in (0, 1)),
    facebookOAuth INTEGER not null default 0 check (googleOAuth in (0, 1)),
    created       INTEGER          default CURRENT_TIMESTAMP,
    lastChanged   INTEGER,
    lastLogin     INTEGER
);
