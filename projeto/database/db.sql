CREATE TABLE users (
  username VARCHAR PRIMARY KEY,
  password VARCHAR,
  name VARCHAR,
  birth_day INTEGER,
  gender VARCHAR,
  email VARCHAR,
  nationality VARCHAR
);

CREATE TABLE channels (
  name VARCHAR PRIMARY KEY,
  author VARCHAR REFERENCES users,
  description VARCHAR
);

CREATE TABLE stories (
  id INTEGER PRIMARY KEY,
  title VARCHAR,
  text VARCHAR,
  author VARCHAR REFERENCES users,
  datetime INTEGER,
  coverImage BLOB,
  track BLOB,
  channel INTEGER REFERENCES channels
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
  type INTEGER, -- either 0 (downvote) or 1 (upvote)
  author VARCHAR REFERENCES users,
  story_id INTEGER REFERENCES stories, -- either story_id or comment_id is NULL
  comment_id INTEGER REFERENCES comments
);

CREATE TABLE subscribed (
  id INTEGER PRIMARY KEY,
  user VARCHAR REFERENCES users,
  channel VARCHAR REFERENCES channels
);


INSERT INTO users VALUES ("admin", "d033e22ae348aeb5660fc2140aec35850c4da997", "admin", "", "", "", ""); -- password in SHA-1 format
INSERT INTO channels VALUES ("general", "admin", "main channel");
INSERT INTO subscribed VALUES (NULL, "admin", "general");
INSERT INTO stories VALUES (0, 'test', NULL, NULL, NULL, NULL, NULL, 'general');
INSERT INTO stories VALUES (1, 'test1', NULL, NULL, NULL, NULL, NULL, 'general');
INSERT INTO comments VALUES (0, 0, "admin", NULL, "sdfknsdlfnsdlf");