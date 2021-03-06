# Leaderboard of all files that were edited this week

git log --date-order --since="-7days ago" --format="% " --numstat . | \
    cut -f 3 | egrep -v '^$' | sort | uniq -c | sort -rn

# Count of PHP files that were touched this week

git log --date-order --since="-7days ago" --format="% " --numstat . | \
    egrep '^.+\.php$' | cut -f3 | sort | uniq | wc -l

# Top committers

git log --format=%cn | sort | uniq -c | sort -rn

# Count of commits per day since the beginning of August

git log --since='august' --format='%ad' --date-order | \
    awk '{print $2" "$3}' | \
    uniq -c | tac | awk '{print $1}' | spark
