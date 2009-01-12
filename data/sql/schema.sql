CREATE TABLE entity (id INT AUTO_INCREMENT, name VARCHAR(255) NOT NULL, code VARCHAR(50) UNIQUE, type SMALLINT, parent_id INT, description TEXT, title VARCHAR(255), created_at DATETIME, updated_at DATETIME, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE email (id INT AUTO_INCREMENT, entity_id INT, email VARCHAR(50), type SMALLINT, INDEX entity_id_idx (entity_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE entity (id INT AUTO_INCREMENT, name VARCHAR(255) NOT NULL, code VARCHAR(50) UNIQUE, type SMALLINT, parent_id INT, description TEXT, title VARCHAR(255), created_at DATETIME, updated_at DATETIME, INDEX parent_id_idx (parent_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE status (id INT AUTO_INCREMENT, name VARCHAR(64), is_resolved TINYINT(1), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_user_permission (user_id INT, permission_id INT, created_at DATETIME, updated_at DATETIME, PRIMARY KEY(user_id, permission_id)) ENGINE = INNODB;
CREATE TABLE sf_guard_user_group (user_id INT, group_id INT, created_at DATETIME, updated_at DATETIME, PRIMARY KEY(user_id, group_id)) ENGINE = INNODB;
CREATE TABLE sf_guard_group (id INT AUTO_INCREMENT, name VARCHAR(255) UNIQUE, description TEXT, created_at DATETIME, updated_at DATETIME, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_remember_key (id INT AUTO_INCREMENT, user_id INT, remember_key VARCHAR(32), ip_address VARCHAR(50), created_at DATETIME, updated_at DATETIME, INDEX user_id_idx (user_id), PRIMARY KEY(id, ip_address)) ENGINE = INNODB;
CREATE TABLE sf_guard_user (id INT AUTO_INCREMENT, username VARCHAR(128) NOT NULL UNIQUE, algorithm VARCHAR(128) DEFAULT 'sha1' NOT NULL, salt VARCHAR(128), password VARCHAR(128), is_active TINYINT(1) DEFAULT '1', is_super_admin TINYINT(1) DEFAULT '0', last_login DATETIME, created_at DATETIME, updated_at DATETIME, INDEX is_active_idx_idx (is_active), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_group_permission (group_id INT, permission_id INT, created_at DATETIME, updated_at DATETIME, PRIMARY KEY(group_id, permission_id)) ENGINE = INNODB;
CREATE TABLE sf_guard_permission (id INT AUTO_INCREMENT, name VARCHAR(255) UNIQUE, description TEXT, created_at DATETIME, updated_at DATETIME, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE location (id INT AUTO_INCREMENT, entity_id INT, type SMALLINT, street VARCHAR(255), city VARCHAR(50), state VARCHAR(50), country VARCHAR(2), postal_code VARCHAR(10), INDEX entity_id_idx (entity_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE issue_activity (id INT AUTO_INCREMENT, issue_id INT, verb VARCHAR(128), created_at DATETIME, created_by INT, body TEXT, changes TEXT, INDEX issue_id_idx (issue_id), INDEX created_by_idx (created_by), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE issue (id INT AUTO_INCREMENT, title VARCHAR(128), project_id INT, component_id INT, milestone_id INT, assigned_to INT, is_closed TINYINT(1) DEFAULT '0' NOT NULL, is_resolved TINYINT(1) DEFAULT '0' NOT NULL, opened_at DATETIME, opened_by INT, resolved_at DATETIME, resolved_by INT, closed_at DATETIME, closed_by INT, status_id INT DEFAULT '1' NOT NULL, category_id INT DEFAULT '1' NOT NULL, priority_id INT DEFAULT '3' NOT NULL, orig_estimate DOUBLE, curr_estimate DOUBLE, elapsed DOUBLE, deadline DATETIME, INDEX project_id_idx (project_id), INDEX component_id_idx (component_id), INDEX assigned_to_idx (assigned_to), INDEX opened_by_idx (opened_by), INDEX resolved_by_idx (resolved_by), INDEX closed_by_idx (closed_by), INDEX status_id_idx (status_id), INDEX category_id_idx (category_id), INDEX priority_id_idx (priority_id), INDEX milestone_id_idx (milestone_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE component (id INT AUTO_INCREMENT, name VARCHAR(64), project_id INT NOT NULL, owner_id INT, INDEX project_id_idx (project_id), INDEX owner_id_idx (owner_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE priority (id INT AUTO_INCREMENT, name VARCHAR(64), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE category (id INT AUTO_INCREMENT, name VARCHAR(64), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE note (id INT AUTO_INCREMENT, entity_id INT, project_id INT, body TEXT, created_at DATETIME, updated_at DATETIME, created_by_user_id INT, updated_by_user_id INT, INDEX entity_id_idx (entity_id), INDEX project_id_idx (project_id), INDEX created_by_user_id_idx (created_by_user_id), INDEX updated_by_user_id_idx (updated_by_user_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE phonenumber (id INT AUTO_INCREMENT, entity_id INT, number VARCHAR(50), type SMALLINT, INDEX entity_id_idx (entity_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE milestone (id INT AUTO_INCREMENT, name VARCHAR(64), project_id INT, date DATETIME, INDEX project_id_idx (project_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE project (id INT AUTO_INCREMENT, name VARCHAR(50) NOT NULL, description TEXT, client_id INT, owner_id INT, created_at DATETIME, updated_at DATETIME, INDEX client_id_idx (client_id), INDEX owner_id_idx (owner_id), PRIMARY KEY(id)) ENGINE = INNODB;
ALTER TABLE email ADD FOREIGN KEY (entity_id) REFERENCES entity(id) ON DELETE CASCADE;
ALTER TABLE entity ADD FOREIGN KEY (parent_id) REFERENCES entity(id) ON DELETE SET NULL;
ALTER TABLE sf_guard_user_permission ADD FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_permission ADD FOREIGN KEY (permission_id) REFERENCES sf_guard_permission(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_group ADD FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_group ADD FOREIGN KEY (group_id) REFERENCES sf_guard_group(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_remember_key ADD FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_group_permission ADD FOREIGN KEY (permission_id) REFERENCES sf_guard_permission(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_group_permission ADD FOREIGN KEY (group_id) REFERENCES sf_guard_group(id) ON DELETE CASCADE;
ALTER TABLE location ADD FOREIGN KEY (entity_id) REFERENCES entity(id) ON DELETE CASCADE;
ALTER TABLE issue_activity ADD FOREIGN KEY (issue_id) REFERENCES issue(id) ON DELETE CASCADE;
ALTER TABLE issue_activity ADD FOREIGN KEY (created_by) REFERENCES sf_guard_user(id);
ALTER TABLE issue ADD FOREIGN KEY (status_id) REFERENCES status(id);
ALTER TABLE issue ADD FOREIGN KEY (resolved_by) REFERENCES sf_guard_user(id);
ALTER TABLE issue ADD FOREIGN KEY (project_id) REFERENCES project(id);
ALTER TABLE issue ADD FOREIGN KEY (priority_id) REFERENCES priority(id);
ALTER TABLE issue ADD FOREIGN KEY (opened_by) REFERENCES sf_guard_user(id);
ALTER TABLE issue ADD FOREIGN KEY (milestone_id) REFERENCES milestone(id);
ALTER TABLE issue ADD FOREIGN KEY (component_id) REFERENCES component(id);
ALTER TABLE issue ADD FOREIGN KEY (closed_by) REFERENCES sf_guard_user(id);
ALTER TABLE issue ADD FOREIGN KEY (category_id) REFERENCES category(id);
ALTER TABLE issue ADD FOREIGN KEY (assigned_to) REFERENCES sf_guard_user(id) ON DELETE SET NULL;
ALTER TABLE component ADD FOREIGN KEY (project_id) REFERENCES project(id) ON DELETE CASCADE;
ALTER TABLE component ADD FOREIGN KEY (owner_id) REFERENCES sf_guard_user(id) ON DELETE SET NULL;
ALTER TABLE note ADD FOREIGN KEY (updated_by_user_id) REFERENCES sf_guard_user(id);
ALTER TABLE note ADD FOREIGN KEY (project_id) REFERENCES project(id) ON DELETE CASCADE;
ALTER TABLE note ADD FOREIGN KEY (entity_id) REFERENCES entity(id) ON DELETE CASCADE;
ALTER TABLE note ADD FOREIGN KEY (created_by_user_id) REFERENCES sf_guard_user(id);
ALTER TABLE phonenumber ADD FOREIGN KEY (entity_id) REFERENCES entity(id) ON DELETE CASCADE;
ALTER TABLE milestone ADD FOREIGN KEY (project_id) REFERENCES project(id) ON DELETE CASCADE;
ALTER TABLE project ADD FOREIGN KEY (owner_id) REFERENCES sf_guard_user(id) ON DELETE SET NULL;
ALTER TABLE project ADD FOREIGN KEY (client_id) REFERENCES entity(id);
