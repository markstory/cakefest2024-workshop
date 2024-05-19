CREATE TABLE users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    email VARCHAR NOT NULL UNIQUE,
    email_verified BOOLEAN NOT NULL DEFAULT false,
    password VARCHAR NOT NULL,
    name VARCHAR,
    last_active DATETIME,
    created DATETIME,
    updated DATETIME
);
CREATE TABLE user_emails (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    user_id INTEGER NOT NULL,
    email VARCHAR NOT NULL,
    email_verified BOOLEAN NOT NULL DEFAULT false,
    created DATETIME,
    updated DATETIME,
    FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE
);
CREATE TABLE organizations (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    slug VARCHAR NOT NULL UNIQUE,
    name VARCHAR,
    created DATETIME,
    updated DATETIME
);
CREATE TABLE organization_options (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    organization_id INTEGER NOT NULL,
    key VARCHAR NOT NULL,
    type VARCHAR DEFAULT string,
    value TEXT,
    created DATETIME,
    modified DATETIME,
    UNIQUE(organization_id, key),
    FOREIGN KEY(organization_id) REFERENCES organizations(id) ON DELETE CASCADE
);
CREATE TABLE organization_members (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    organization_id INTEGER NOT NULL,
    user_id INTEGER NOT NULL,
    role VARCHAR NOT NULL DEFAULT 'member',
    created DATETIME,
    modified DATETIME,
    FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY(organization_id) REFERENCES organizations(id) ON DELETE CASCADE
);
CREATE TABLE organization_invites (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    organization_id INTEGER NOT NULL,
    email VARCHAR NOT NULL,
    role VARCHAR NOT NULL DEFAULT 'member',
    teams VARCHAR,
    organization_member_id INTEGER,
    created DATETIME,
    modified DATETIME,
    FOREIGN KEY(organization_member_id) REFERENCES organization_members(id) ON DELETE CASCADE,
    FOREIGN KEY(organization_id) REFERENCES organizations(id) ON DELETE CASCADE
);
CREATE TABLE teams (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    organization_id INTEGER NOT NULL,
    slug VARCHAR NOT NULL,
    name VARCHAR,
    created DATETIME,
    modified DATETIME,
    UNIQUE(organization_id, slug),
    FOREIGN KEY(organization_id) REFERENCES organizations(id) ON DELETE CASCADE
);
CREATE TABLE team_members (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    team_id INTEGER NOT NULL,
    organization_member_id INTEGER NOT NULL,
    created DATETIME,
    modified DATETIME,
    FOREIGN KEY(organization_member_id) REFERENCES organization_members(id) ON DELETE CASCADE,
    FOREIGN KEY(team_id) REFERENCES teams(id) ON DELETE CASCADE
);
CREATE TABLE options (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    key VARCHAR NOT NULL UNIQUE,
    type VARCHAR DEFAULT string,
    value TEXT,
    created DATETIME,
    modified DATETIME
);
CREATE TABLE projects (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    organization_id INTEGER NOT NULL,
    slug VARCHAR NOT NULL,
    name VARCHAR,
    created DATETIME,
    modified DATETIME,
    FOREIGN KEY(organization_id) REFERENCES organizations(id) ON DELETE CASCADE
);
CREATE TABLE projects_teams (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    project_id INTEGER NOT NULL,
    team_id INTEGER NOT NULL,
    created DATETIME,
    modified DATETIME,
    FOREIGN KEY(project_id) REFERENCES projects(id) ON DELETE CASCADE,
    FOREIGN KEY(team_id) REFERENCES teams(id) ON DELETE CASCADE
);
