CREATE TABLE users (
  username VARCHAR PRIMARY KEY,
  password VARCHAR,
  name VARCHAR
);

CREATE TABLE channels (
  id INTEGER PRIMARY KEY,
  name VARCHAR,
  author VARCHAR REFERENCES users
)

CREATE TABLE stories (
  id INTEGER PRIMARY KEY,
  title VARCHAR,
  text VARCHAR,
  author VARCHAR REFERENCES users,
  date INTEGER
);

CREATE TABLE comments (
  id INTEGER PRIMARY KEY,
  story_id INTEGER REFERENCES stories,
  author VARCHAR REFERENCES users,
  date INTEGER,
  text VARCHAR
);

CREATE TABLE vote (
  id INTEGER PRIMARY KEY,
  type VARCHAR, -- either 'UP' or 'DOWN'
  author VARCHAR REFERENCES users,
  story_id INTEGER REFERENCES stories, -- either story_id or comment_id is NULL
  comment_id INTEGER REFERENCES comments
);

INSERT INTO users VALUES ("admin", "d033e22ae348aeb5660fc2140aec35850c4da997", "admin"); -- password in SHA-1 format
INSERT INTO channels VALUES (NULL, "general", "admin");