# Cross-Site Scripting (XSS) Challenge

## Overview
This challenge introduces you to Cross-Site Scripting (XSS) vulnerabilities. XSS allows attackers to inject malicious client-side scripts into web pages viewed by other users.

## Difficulty
- Level: Beginner

## Learning Objectives
- Understand how XSS vulnerabilities occur
- Learn how to identify and exploit different types of XSS vulnerabilities
- Understand the impact of XSS attacks
- Learn how to prevent XSS vulnerabilities

## Challenge Background
You've discovered a message board application that allows users to post comments. The developers have failed to properly sanitize user input, creating an XSS vulnerability.

## Your Mission
1. Explore the message board functionality
2. Find a way to inject and execute JavaScript in the application
3. Create a payload that displays an alert box with the text "XSS Successful!"
4. Create a more advanced payload that steals cookies (for educational purposes only)

## Hints
<details>
  <summary>Hint 1: Getting started</summary>
  
  Try posting a message with simple HTML tags. Does the application render them?
</details>

<details>
  <summary>Hint 2: Script execution</summary>
  
  If HTML tags work, can you inject a `<script>` tag? Try a simple JavaScript alert.
</details>

<details>
  <summary>Hint 3: Evading filters</summary>
  
  If direct script tags are blocked, there are many other ways to execute JavaScript in a browser. Try event handlers like `onload` or `onerror`.
</details>

## Success Criteria
You have completed this challenge when you can:
1. Successfully inject JavaScript that executes in the browser
2. Display an alert box with the text "XSS Successful!"
3. Explain how the vulnerability could be fixed

## Prevention
After completing the challenge, review the following secure coding practices:
- Always validate and sanitize user input
- Use content security policies (CSP)
- Implement output encoding
- Consider using modern frameworks that automatically escape output
- Apply the principle of least privilege