CREATE TABLE users (
  username VARCHAR PRIMARY KEY,
  password VARCHAR,
  name VARCHAR,
  birth_day INTEGER,
  gender VARCHAR,
  email VARCHAR,
  nationality VARCHAR,
  points INTEGER
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
  comments INTEGER,
  channel VARCHAR REFERENCES channels
);

CREATE TABLE comments (
  id INTEGER PRIMARY KEY,
  story_id INTEGER REFERENCES stories,
  author VARCHAR REFERENCES users,
  upvotes INTEGER,
  downvotes INTEGER,
  datetime DATETIME,
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
WHEN NEW.type = 1 AND NEW.story_id IS NOT NULL
BEGIN
	UPDATE stories SET upvotes = upvotes + 1 WHERE id = NEW.story_id;
  UPDATE users
  SET points = points + 1
  WHERE username IN
  (
    SELECT author
    FROM stories
    WHERE id = NEW.story_id
  );		
END;

CREATE TRIGGER onAddDownvoteStory
BEFORE INSERT ON vote
WHEN NEW.type = 0 AND NEW.story_id IS NOT NULL
BEGIN
	UPDATE stories SET downvotes = downvotes + 1 WHERE id = NEW.story_id;	
  UPDATE users
  SET points = points - 1
  WHERE username IN
  (
    SELECT author
    FROM stories
    WHERE id = NEW.story_id
  );	
END;

CREATE TRIGGER onChangeUpvoteStory  
BEFORE UPDATE ON vote
WHEN NEW.type = 1 AND NEW.story_id IS NOT NULL
BEGIN
	UPDATE stories SET upvotes = upvotes + 1 WHERE id = NEW.story_id;		
	UPDATE stories SET downvotes = downvotes - 1 WHERE id = NEW.story_id;
  UPDATE users
  SET points = points + 1
  WHERE username IN
  (
    SELECT author
    FROM stories
    WHERE id = NEW.story_id
  );		
END;

CREATE TRIGGER onChangeDownvoteStory
BEFORE UPDATE ON vote
WHEN NEW.type = 0 AND NEW.story_id IS NOT NULL
BEGIN
	UPDATE stories SET downvotes = downvotes + 1 WHERE id = NEW.story_id;	
	UPDATE stories SET upvotes = upvotes - 1 WHERE id = NEW.story_id;
  UPDATE users
  SET points = points - 1
  WHERE username IN
  (
    SELECT author
    FROM stories
    WHERE id = NEW.story_id
  );	
END;  

CREATE TRIGGER onRemoveUpvoteStory
BEFORE DELETE ON vote 
WHEN OLD.type = 1 AND OLD.story_id IS NOT NULL
BEGIN
	UPDATE stories SET upvotes = upvotes - 1 WHERE id = OLD.story_id;
  UPDATE users
  SET points = points - 1
  WHERE username IN
  (
    SELECT author
    FROM stories
    WHERE id = OLD.story_id
  );	
END;

CREATE TRIGGER onRemoveDownvoteStory
BEFORE DELETE ON vote 
WHEN OLD.type = 0 AND OLD.story_id IS NOT NULL
BEGIN
	UPDATE stories SET downvotes = downvotes - 1 WHERE id = OLD.story_id;
  UPDATE users
  SET points = points + 1
  WHERE username IN
  (
    SELECT author
    FROM stories
    WHERE id = OLD.story_id
  );	
END;

CREATE TRIGGER onAddUpvoteComment
BEFORE INSERT ON vote
WHEN NEW.type = 1 AND NEW.comment_id IS NOT NULL
BEGIN
	UPDATE comments SET upvotes = upvotes + 1 WHERE id = NEW.comment_id;
  UPDATE users
  SET points = points + 1
  WHERE username IN
  (
    SELECT author
    FROM comments
    WHERE id = NEW.comment_id
  );		
END;

CREATE TRIGGER onAddDownvoteComment
BEFORE INSERT ON vote
WHEN NEW.type = 0 AND NEW.comment_id IS NOT NULL
BEGIN
	UPDATE comments SET downvotes = downvotes + 1 WHERE id = NEW.comment_id;
  UPDATE users
  SET points = points - 1
  WHERE username IN
  (
    SELECT author
    FROM comments
    WHERE id = NEW.comment_id
  );		
END;

CREATE TRIGGER onChangeUpvoteComment
BEFORE UPDATE ON vote
WHEN NEW.type = 1 AND NEW.comment_id IS NOT NULL
BEGIN
	UPDATE comments SET upvotes = upvotes + 1 WHERE id = NEW.comment_id;		
	UPDATE comments SET downvotes = downvotes - 1 WHERE id = NEW.comment_id;
  UPDATE users
  SET points = points + 1
  WHERE username IN
  (
    SELECT author
    FROM comments
    WHERE id = NEW.comment_id
  );		
END;

CREATE TRIGGER onChangeDownvoteComment
BEFORE UPDATE ON vote
WHEN NEW.type = 0 AND NEW.comment_id IS NOT NULL
BEGIN
	UPDATE comments SET downvotes = downvotes + 1 WHERE id = NEW.comment_id;	
	UPDATE comments SET upvotes = upvotes - 1 WHERE id = NEW.comment_id;
  UPDATE users
  SET points = points - 1
  WHERE username IN
  (
    SELECT author
    FROM comments
    WHERE id = NEW.comment_id
  );	
END;

CREATE TRIGGER onRemoveUpvoteComment
BEFORE DELETE ON vote
WHEN OLD.type = 1 AND OLD.comment_id IS NOT NULL
BEGIN
	UPDATE comments SET upvotes = upvotes - 1 WHERE id = OLD.comment_id;
  UPDATE users
  SET points = points - 1
  WHERE username IN
  (
    SELECT author
    FROM comments
    WHERE id = OLD.comment_id
  );	
END;

CREATE TRIGGER onRemoveDownvoteComment
BEFORE DELETE ON vote
WHEN OLD.type = 0 AND OLD.comment_id IS NOT NULL
BEGIN
	UPDATE comments SET downvotes = downvotes - 1 WHERE id = OLD.comment_id;
  UPDATE users
  SET points = points + 1
  WHERE username IN
  (
    SELECT author
    FROM comments
    WHERE id = OLD.comment_id
  );	
END;

CREATE TRIGGER onComment
BEFORE INSERT ON comments
BEGIN
  UPDATE stories SET comments = comments + 1 WHERE id = NEW.story_id;	
END;


INSERT INTO users VALUES ("admin", "$2y$12$BZci9/LKCEtXotem0LHZuOAI3BfHrTZ.id3UFTdWZ/0B0dkIgWwAC", "admin", "", "", "", "", 0); -- password in SHA-1 format
INSERT INTO channels VALUES ("general", "admin", "Main Channel");
INSERT INTO subscribed VALUES (NULL, 'admin', 'general');
INSERT INTO stories VALUES (0, 'Sample Track', 'Sample Test Track', 'admin', '12-12-2018 02:33:58', 0, 0, 0, 'general');