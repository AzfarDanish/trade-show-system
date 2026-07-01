# Laravel Models Documentation

Generated on: 2026-07-01 05:45:06

## appointments

**Table:** appointments

**Primary Key:** appointment_id

### Columns
| Field | Type | Null | Default |
|------|------|------|---------|
| appointment_id | bigint unsigned | NO | NULL | 
| exhibitor_id | bigint unsigned | NO | NULL | 
| client_name | varchar(255) | NO | NULL | 
| appointment_date | date | NO | NULL | 
| appointment_time | time | NO | NULL | 
| purpose | text | NO | NULL | 
| status | enum('Pending','Confirmed','Completed','Cancelled') | NO | Pending | 
| created_at | timestamp | YES | NULL | 
| updated_at | timestamp | YES | NULL | 

### Fillable
- exhibitor_id
- client_name
- appointment_date
- appointment_time
- purpose
- status

### Casts
- appointment_id => int

### Relationships

### Accessors & Mutators
- `` (accessor)
- `` (mutator)

---

## booths

**Table:** booths

**Primary Key:** booth_id

### Columns
| Field | Type | Null | Default |
|------|------|------|---------|
| booth_id | bigint unsigned | NO | NULL | 
| exhibitor_id | bigint unsigned | NO | NULL | 
| show_id | bigint unsigned | YES | NULL | 
| booth_number | varchar(255) | NO | NULL | 
| location | varchar(255) | NO | NULL | 
| created_at | timestamp | YES | NULL | 
| updated_at | timestamp | YES | NULL | 

### Fillable
- exhibitor_id
- booth_number
- location
- show_id

### Casts
- booth_id => int

### Relationships

### Accessors & Mutators
- `` (accessor)
- `` (mutator)

---

## exhibitors

**Table:** exhibitors

**Primary Key:** exhibitor_id

### Columns
| Field | Type | Null | Default |
|------|------|------|---------|
| exhibitor_id | bigint unsigned | NO | NULL | 
| user_id | bigint unsigned | NO | NULL | 
| company_name | varchar(255) | NO | NULL | 
| representative_name | varchar(255) | NO | NULL | 
| phone_number | varchar(255) | NO | NULL | 
| status | enum('active','inactive') | NO | active | 
| created_at | timestamp | YES | NULL | 
| updated_at | timestamp | YES | NULL | 

### Fillable
- user_id
- company_name
- representative_name
- phone_number
- status

### Casts
- exhibitor_id => int

### Relationships

### Accessors & Mutators
- `` (accessor)
- `` (mutator)

---

## leads

**Table:** leads

**Primary Key:** lead_id

### Columns
| Field | Type | Null | Default |
|------|------|------|---------|
| lead_id | bigint unsigned | NO | NULL | 
| exhibitor_id | bigint unsigned | NO | NULL | 
| lead_name | varchar(255) | NO | NULL | 
| company_name | varchar(255) | NO | NULL | 
| phone | varchar(255) | NO | NULL | 
| email | varchar(255) | NO | NULL | 
| notes | text | YES | NULL | 
| created_at | timestamp | YES | NULL | 
| updated_at | timestamp | YES | NULL | 

### Fillable
- exhibitor_id
- lead_name
- company_name
- phone
- email
- notes

### Casts
- lead_id => int

### Relationships

### Accessors & Mutators
- `` (accessor)
- `` (mutator)

---

## shows

**Table:** shows

**Primary Key:** show_id

### Columns
| Field | Type | Null | Default |
|------|------|------|---------|
| show_id | bigint unsigned | NO | NULL | 
| name | varchar(255) | NO | NULL | 
| status | enum('active','ended') | NO | active | 
| start_date | date | YES | NULL | 
| end_date | date | YES | NULL | 
| poster | varchar(255) | YES | NULL | 
| created_at | timestamp | YES | NULL | 
| updated_at | timestamp | YES | NULL | 

### Fillable
- name
- status
- start_date
- end_date
- poster

### Casts
- show_id => int

### Relationships

### Accessors & Mutators
- `` (accessor)
- `` (mutator)

---

## users

**Table:** users

**Primary Key:** id

### Columns
| Field | Type | Null | Default |
|------|------|------|---------|
| id | bigint unsigned | NO | NULL | 
| name | varchar(255) | NO | NULL | 
| email | varchar(255) | NO | NULL | 
| password | varchar(255) | NO | NULL | 
| role | enum('admin','exhibitor') | NO | NULL | 
| created_at | timestamp | YES | NULL | 
| updated_at | timestamp | YES | NULL | 

### Fillable
- name
- email
- password
- role

### Casts
- id => int

### Relationships

### Accessors & Mutators
- `` (accessor)
- `` (mutator)

---

