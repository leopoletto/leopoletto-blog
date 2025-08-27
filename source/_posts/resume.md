---
extends: _layouts.post
section: content
title: "Resume"
date: 2025-08-22
description: "Senior Full-Stack Engineer | Node.js, Laravel, Vue | Performance & Automation"
featured: false
published: true
type: page
categories: ["open-lab"]
og_title: "Resume"
og_type: article
og_description: "Senior Full-Stack Engineer | Node.js, Laravel, Vue | Performance & Automation"
og_image: "assets/images/og/resume.webp"
x_title: "Resume"
x_description: "Senior Full-Stack Engineer | Node.js, Laravel, Vue | Performance & Automation"
x_image: "assets/images/og/resume.webp"
---



São Paulo, Brazil  
[hello@leopoletto.com](mailto:hello@leopoletto.com) | [LinkedIn](https://www.linkedin.com/in/leopoletto) |  [Twitter](https://twitter.com/leopoletto)  | [GitHub](https://github.com/leopoletto)

## Summary

I’m a Senior Full-Stack Engineer who builds production-ready applications and automation tools across Node.js and PHP ecosystems, combining backend services, browser automation, and system-level scripting.

Over the last several years, I’ve:

- Delivered **full-stack web apps** with Laravel, Vue, and modern JS pipelines.
- Built **automation tooling** with `Node.js`, `Puppeteer`, and `Commander.js` — everything from data extraction to site performance auditing.
- Engineered **performance workflows** that measure Core Web Vitals, enforce `CSP/SRI` security, and optimize web fonts.
- Wrapped **Google's production** `C++` `robots.txt` parser in `Node.js` for high-accuracy crawl compliance.
- Created **Chrome extensions** for privacy and request monitoring.

Beyond shipping code, I’ve launched **Wizard Compass**, an educational initiative that turns Chrome Lighthouse audits into interactive lessons. My goal is to make complex performance, accessibility, and security concepts **understandable and actionable** for developers of all levels.

I thrive in roles where I can solve hard technical problems, mentor others, and deliver measurable improvements to reliability, speed, and security.

**Tech Stack:** `Node.js`, `Puppeteer`, `Commander.js`, `p-limit`, `Laravel`, `Vue.js`, `MySQL`, `Redis`, `Docker`, `GitHub Actions`, `Bash/Unix (jq, yq)`, `Chrome Extension APIs`, `Chrome Lighthouse`.
  
---  

## Projects


### Font Lint - Font Metrics & Licensing Analyzer

Jul 2025 – Present | Associated with Wizard Compass Initiative

Font Lint is a developer tool and service that brings transparency and optimization to web typography.

**Advanced Font Metrics & Subsetting**

- Extracted `x-height`, `cap height`, `avg. character width`, `ascender/descender` across ~1,800 Google Fonts. 
- Generated subset metrics per Unicode range (Latin, Cyrillic, Greek, Vietnamese, etc.) to quantify layout stability and load cost. 
- Designed a comparison system for fonts and fallbacks at a sub-metric level to reduce CLS (Cumulative Layout Shift).

**Data Ingestion & Classification**

- Built ingestion pipeline in `Laravel` + `Python` to parse Google Fonts metadata, `TTF/WOFF2` tables, and licenses.
- Classified fonts (emoji, symbol, barcode, textual) to skip unnecessary submetric computation.
- Maintained relational DB (families, variants, subsets, metrics, licensing, categories, tags).

**Licensing & Compliance**

- Audited declared Google Fonts licenses vs. actual font-level licenses (`Apache-2.0`, `SIL OFL-1.1`, `GPL`).
- Extracted reserved font names from font metadata to ensure compliant redistribution and subsetting.
- Generated compliance outputs (SPDX IDs, license notices, attribution bundles).

**Developer-Facing Tools**

- Generated device-aware fallback stacks with size-adjust, ascent-override, and descent-override.
- Experimented with Unicode coverage “Can I use this glyph?” service mapping fonts to supported `codepoints`.
- Built foundation for a “`Tailwind for Fonts`” optimizer: pruning unused glyphs, subsetting fonts by frequency, and emitting optimized CSS.

**Skills:** `Web Typography` · `Laravel` · `Python` · `Node.js` · `Bash`
  
---  

### Wizard Compass — Interactive Lighthouse Education Platform


May 2025 – Present | Wizard Compass Initiative

Wizard Compass is an educational platform that transforms `Chrome Lighthouse` audits into guided lessons, turning raw scores into actionable knowledge.

**Core Contributions**

- Designed and launched an interactive learning platform where Lighthouse reports become step-by-step lessons.
- Built teaching modules combining code examples, real audits, and clear explanations.
- Created a foundation for a growing library of micro-courses and playgrounds, enabling hands-on learning.
- Prioritized accessibility, security, and open data to ensure lessons are practical and trustworthy.

**Mission**

Make web performance and accessibility knowledge accessible to everyone — from students to senior engineers — by combining real-world tools with clear, human-first education.

**Skills:** `Teaching` · `Lighthouse` · `Screencasting` · `Chrome DevTools` · `Web Performance`
  
---  

## Experience

### Wizard Compass Initiative — Founder & Engineer (Independent Initiative)

Jan 2025 – Present | Brazil

- Designed and shipped production-ready tools and educational resources focused on web performance, security, and automation.
- Built `Node.js` CLI tools (`Commander.js`, `p-limit`) with Unix utilities (`jq`, `yq`).
- Developed Puppeteer scripts for site data extraction, `CSP/SRI` checks, and font loading audits.
- Integrated Lighthouse programmatic API into automated pipelines.
- Created a Chrome extension for real-time privacy monitoring.
- Engineered a robots.txt parser workflow with `Node.js` + `Google’s C++` parser.

---  

### StudentCrowd — Software Engineer

Jan 2024 – Jan 2025 | London, UK

- Improved platform performance (higher Lighthouse scores, Q1 OKR achieved).
- Built a reliable **email verification workflow**, boosting registrations.
- Redesigned **user registration flow** and developed full account area.
- Delivered **two-way data sync** between platform and email provider.
- Contributed to advanced filters using **Elasticsearch** and **BigQuery**.

---  

### AE Studio— JavaScript Developer

Apr 2022 – Dec 2022 | California, USA (Remote)

- Contributed to **Token Talkers**, a Web3 skunkworks project.
- Built full-stack features using **NullStack** (unified server/client logic).
- Architected **MongoDB connections**, Web3 wallet integration, and logging.
- Built a **dynamic scheduling system** powered by `Calendly`.
- Delivered **mobile-first UI** with Tailwind CSS.
- Contributed to gamified features during an internal hackathon.

---  

### 99Codes — Software Engineer & Cofounder

Aug 2014 – May 2022 | Brazil

- Led custom full-stack projects across education, legal tech, communications, and healthcare.
- Built multi-tenant SaaS platforms and responsive sites using **`Laravel`, `Vue.js`, `MySQL` `Tailwind CS`, `WordPress`**.
- Deployed on **scalable infrastructures** like `Laravel Forge`.

---  

### Simple Education — Software Engineer

Mar 2019 – May 2020 | Brazil

- Drove evolution of a **full educational ecosystem** (LMS, CRM, e-commerce, apps).
- Led technical coordination of interconnected systems and vendor management.
- Built integrations for **media conversion, subtitling, TTS, speech recognition, and AWS services**.
- Supported thousands of students across Brazil.

---  

##  Early Career (2010 – 2014)


### ED Comunicação — Full-Stack Developer


Jun 2012 – May 2014 | São Paulo, Brazil

- Converted agency PDF designs into **responsive, pixel-perfect HTML/CSS** integrated with CakePHP and WordPress.
- Acted as the **technical voice in client meetings**, supporting the agency owner.
- Delivered projects for clients including **NEC, Mitsubishi, BMW, Kawasaki, BIG Festival, and Suzano Papel e Celulose** (one of the world’s largest pulp manufacturers).


### Jhma Studios — Full-Stack Developer

Jul 2011 – Jun 2012 | Brazil

- Rebuilt the **full product catalog for ACE Revestimentos**, delivering 10+ responsive templates.
- Developed a **custom PHP OOP admin panel** before mainstream frameworks.
- Implemented **SEO-preserving redirects** via an XML-driven system, ensuring clean URLs while keeping Google rankings.
- Result: improved indexed product count and search visibility.

### AG5 Desenvolvimento de Sistemas — Full-Stack Developer

Jan 2010 – Jun 2010 | São Paulo, Brazil

- Built a **registration system** for the Annual Franchise Convention, featuring national star Rodrigo Faro.
- Rebuilt the company website into a **responsive, faster layout** (post-`Dreamweaver`).
- Developed an **incentive sales portal** with weekly updated rankings and performance news, gamifying competition across franchisees.
- First role transitioning from static websites to **dynamic web applications**, applying early `PHP/OOP` practices.

---  

## Education

### Impacta Tecnologia

Technologist in System Analysis, IT (2010 – 2014)

Completed the majority of coursework in Systems Analysis (2010–2014), specializing in IT fundamentals, databases, and programming. Did not pursue a diploma but applied knowledge directly in professional development roles

### ETEC - Escola Técnica Estadual de São Paulo

Technical Program in Computer Science (2007–2008)

- Studied `algorithms`, `Pascal`, `Delphi`, and `Visual Basic` with daily coursework.
- Participated in the **Brazilian Computer Science Olympiad**.
- Built a strong foundation in structured programming and problem-solving.

  
---  


Skills: **IT fundamentals** · **Databases** · **Pascal** · **Delphi** · **VB Studio** · **Algorithms** · **Data Structures**
  
---  

## Skills

- **Top Skills:** PHP, Laravel, Node.js, Vue.js, Tailwind CSS, Chrome API, Google Cloud, Web Typography, Python, Bash
- **Languages:** Portuguese (Native), English (Full Professional)