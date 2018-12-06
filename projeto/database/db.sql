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
  datetime DATETIME,
  upvotes INTEGER,
  downvotes INTEGER,
  coverImage BLOB,
  track BLOB,
  channel VARCHAR REFERENCES channels
);

CREATE TABLE comments (
  id INTEGER PRIMARY KEY,
  story_id INTEGER REFERENCES stories,
  author VARCHAR REFERENCES users,
  datetime DATETIME,
  upvotes INTEGER,
  downvotes INTEGER,
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

CREATE TRIGGER onAddUpvoteStory
BEFORE INSERT ON vote
WHEN NEW.type = 1 AND NEW.story_id != NULL
BEGIN
	UPDATE stories SET upvotes = upvotes + 1 WHERE id = NEW.story_id;		
END;

CREATE TRIGGER onAddDownvoteStory
BEFORE INSERT ON vote
WHEN NEW.type = 0 AND NEW.story_id != NULL
BEGIN
	UPDATE stories SET downvotes = downvotes + 1 WHERE id = NEW.story_id;		
END;

CREATE TRIGGER onChangeUpvoteStory  
BEFORE UPDATE ON vote
WHEN NEW.type = 1 AND NEW.story_id != NULL
BEGIN
	UPDATE stories SET upvotes = upvotes + 1 WHERE id = NEW.story_id;		
	UPDATE stories SET downvotes = downvotes - 1 WHERE id = NEW.story_id;		
END;

CREATE TRIGGER onChangeDownvoteStory
BEFORE UPDATE ON vote
WHEN NEW.type = 0 AND NEW.story_id != NULL
BEGIN
	UPDATE stories SET downvotes = downvotes + 1 WHERE id = NEW.story_id;	
	UPDATE stories SET upvotes = upvotes - 1 WHERE id = NEW.story_id;	
END;

CREATE TRIGGER onRemoveUpvoteStory
BEFORE DELETE ON vote 
WHEN OLD.type = 1 AND OLD.story_id != NULL
BEGIN
	UPDATE stories SET upvotes = upvotes - 1 WHERE id = OLD.story_id;	
END;

CREATE TRIGGER onRemoveDownvoteStory
BEFORE DELETE ON vote 
WHEN OLD.type = 0 AND OLD.story_id != NULL
BEGIN
	UPDATE stories SET downvotes = downvotes - 1 WHERE id = OLD.story_id;	
END;

CREATE TRIGGER onAddUpvoteComment
BEFORE INSERT ON vote
WHEN NEW.type = 1 AND NEW.comment_id != NULL
BEGIN
	UPDATE comments SET upvotes = upvotes + 1 WHERE id = NEW.comment_id;		
END;

CREATE TRIGGER onAddDownvoteComment
BEFORE INSERT ON vote
WHEN NEW.type = 0 AND NEW.comment_id != NULL
BEGIN
	UPDATE stories SET downvotes = downvotes + 1 WHERE id = NEW.story_id;		
END;

CREATE TRIGGER onChangeUpvoteComment
BEFORE UPDATE ON vote
WHEN NEW.type = 1 AND NEW.comment_id != NULL
BEGIN
	UPDATE stories SET upvotes = upvotes + 1 WHERE id = NEW.story_id;		
	UPDATE stories SET downvotes = downvotes - 1 WHERE id = NEW.story_id;		
END;

CREATE TRIGGER onChangeDownvoteComment
BEFORE UPDATE ON vote
WHEN NEW.type = 0 AND NEW.comment_id != NULL
BEGIN
	UPDATE stories SET downvotes = downvotes + 1 WHERE id = NEW.story_id;	
	UPDATE stories SET upvotes = upvotes - 1 WHERE id = NEW.story_id;	
END;

CREATE TRIGGER onRemoveUpvoteComment
BEFORE DELETE ON vote
WHEN OLD.type = 1 AND OLD.comment_id != NULL
BEGIN
	UPDATE stories SET upvotes = upvotes - 1 WHERE id = OLD.story_id;	
END;

CREATE TRIGGER onRemoveDownvoteComment
BEFORE DELETE ON vote
WHEN OLD.type = 0 AND OLD.comment_id != NULL
BEGIN
	UPDATE stories SET downvotes = downvotes - 1 WHERE id = OLD.story_id;	
END;


INSERT INTO users VALUES ("admin", "d033e22ae348aeb5660fc2140aec35850c4da997", "admin", "", "", "", ""); -- password in SHA-1 format
INSERT INTO channels VALUES ("general", "admin", "main channel");
INSERT INTO subscribed VALUES (NULL, 'admin', 'general');
INSERT INTO stories VALUES (0, 'test', 'ahhhhhh', 'admin', date('now'), 0, 0, NULL, NULL, 'general');
INSERT INTO stories VALUES (NULL, 'test1', 'hhhhhhhh', 'admin', date('now'), 0, 0, NULL, NULL, 'general');
INSERT INTO vote VALUES (NULL, 1, 'admin', 0, NULL);
INSERT INTO comments VALUES (0, 0, 'admin', date('now'), 0, 0, NULL, 'sdfknsdlfnsdlf');