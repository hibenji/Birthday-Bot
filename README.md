# Birthday Bot

A simple website that will send you a reminder via discord (webhooks) when its someone's birthday.

## Setup

1. Make a mysql database with the following structure.

| id | name   | date         |
|----|--------|--------------|
| 1  | name | YYYY-MM-DD |
| 2  | name | YYYY-MM-DD |

2. Change the values in the config.

3. Add a Crontab (Change number for less or more checks)

`* */6 * * * curl https://birthdays.benji.link >/dev/null 2>&1`
