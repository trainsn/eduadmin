drop database if exists eduadmin;
create database eduadmin;
use eduadmin;

drop table if exists info_user;
create table info_user
(
	user_id int not null auto_increment,
	account varchar(20),
	username varchar(20),
	password varchar(255),
	job tinyint,
	authority enum('S','T','A'),
    primary key (user_id)
)DEFAULT CHARSET=utf8;

drop table if exists info_course;
create table info_course
(
	course_id int not null auto_increment,
	name varchar(20),
    classroom varchar(20),
    suit  enum('S','T','A'),
    capacity int,
    selectedMan int,
    teacher int,
	primary key (course_id),
    foreign key (teacher) references info_user(user_id)
)DEFAULT CHARSET=utf8;

drop table if exists info_selected;
create table info_selected
(
	user_id int,
    course_id int,
    primary key(user_id,course_id),
    foreign key (user_id) references info_user(user_id),
    foreign key (course_id) references info_course(course_id)
)DEFAULT CHARSET=utf8;

drop table if exists info_classtime;
create table info_classtime
(
	course_id int,
    startTime int,
    endTime int,
    primary key(course_id,startTime),
    foreign key (course_id) references info_course(course_id)
)DEFAULT CHARSET=utf8;




