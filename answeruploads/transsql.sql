select * from BCA
begin tran
insert into BCA values(4,'sujan','bhaktapur',9812345678);
commit
rollback