CREATE TABLE IF NOT EXISTS users (
    ID bigint(20)  unsigned  NOT NULL AUTO_INCREMENT ,
    email varchar(255) NOT NULL,
    password varchar(255) NOT NULL,
    age tinyint(3) unsigned NOT NULL,
    country varchar(255) NOT NULL,
    social_media_url varchar(255) NOT NULL,
    created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP() ,
    updated_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    PRIMARY KEY(ID),
    UNIQUE KEY(email)

);

CREATE TABLE IF NOT EXISTS transactions (
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    description varchar(255) NOT NULL,
    amount decimal(10,2) NOT NULL,
    date datetime NOT NULL,
    created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    updated_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    user_id bigint(20) unsigned,
    PRIMARY KEY(id),
    FOREIGN KEY(user_id) REFERENCES users(ID)
);

CREATE TABLE IF NOT EXISTS receipts(
  id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  original_filename varchar(255) NOT NULL,
  storage_filename varchar(255) NOT NULL,
  media_type varchar(255) NOT NULL,
  transaction_id  bigint(20) unsigned NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY(transaction_id) REFERENCES transactions(id) ON DELETE CASCADE
);