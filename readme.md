## App generates schedule from json

- *schedule.json* contains list of jobs with crontab time formats.
- *lastRun* property contains the date of the last execution of the scheduler. it can be *false* or in DateTime format "*2017-10-06 12:00:00*"
- when app starts - it shows first 100 next items from the schedule (starting from now)
- if *lastRun* is set - it shows first 100 items starting from lastRun date

PS: please pay attention, that I'm not a Backend developer! I'm a frontend developer!