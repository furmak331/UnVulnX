# SQL Injection Challenge

## Overview
This challenge simulates a common SQL injection vulnerability in a user lookup system. Your goal is to exploit this vulnerability to gain unauthorized access to user data.

## Difficulty
- Level: Beginner

## Learning Objectives
- Understand how SQL injection vulnerabilities occur
- Learn how to identify and exploit SQL injection vulnerabilities
- Understand the impact of successful SQL injection attacks
- Learn how to prevent SQL injection vulnerabilities

## Challenge Background
You've discovered a user management system that allows looking up users by ID. The developers have implemented this feature without proper input validation, creating a SQL injection vulnerability.

## Your Mission
1. Explore the user lookup functionality
2. Find a way to exploit the SQL injection vulnerability
3. Retrieve information about all users in the database
4. Find the admin user's password hash

## Hints
<details>
  <summary>Hint 1: Getting started</summary>
  
  Try entering a simple ID number and observe the response. What happens if you include SQL syntax in your input?
</details>

<details>
  <summary>Hint 2: Breaking out</summary>
  
  In SQL, single quotes (') are used to denote string literals. What happens if you add a single quote to your input?
</details>

<details>
  <summary>Hint 3: UNION attacks</summary>
  
  SQL UNION allows you to combine results from multiple SELECT statements. Can you use this to retrieve data from other tables?
</details>

## Success Criteria
You have completed this challenge when you can:
1. Extract a list of all users in the database
2. Retrieve the admin user's password hash
3. Explain how the vulnerability could be fixed

## Prevention
After completing the challenge, review the following secure coding practices:
- Use parameterized queries or prepared statements
- Implement input validation
- Apply the principle of least privilege for database users
- Consider using an ORM (Object-Relational Mapping) framework