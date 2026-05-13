# Use Cases - ksf_JobDescriptions Module

## Document Information
- **Module**: ksf_JobDescriptions
- **Version**: 1.0.0
- **Date**: 2026-05-13
- **Based on**: Business Requirements v1.0.0

---

## Use Case 1: Create Job Description

| Field | Value |
|-------|-------|
| **Use Case ID** | JD-UC-001 |
| **Actor** | HR Manager, Department Head, HR Administrator |
| **Description** | Create a new job description with all required fields including title, department, grade, responsibilities, skills, and requirements |

### Pre-conditions
1. Actor is authenticated and has permission to create job descriptions
2. Actor has access to the ksf_JobDescriptions module
3. Required reference data exists (departments, grades, skill libraries)

### Steps
1. Actor navigates to Job Descriptions section
2. Actor selects "Create New Job Description"
3. System displays empty job description form
4. Actor enters **Title** (e.g., "Senior Software Engineer")
5. Actor selects **Department** from dropdown
6. Actor selects **Grade** from salary grade list
7. Actor enters **Summary** (brief role overview, 2-3 sentences)
8. Actor adds **Responsibilities** (multi-line list of duties)
9. Actor adds **Required Skills** (select from library or enter new)
10. Actor adds **Preferred Skills** (optional, select from library or enter new)
11. Actor selects **Education Requirements** (degree level, field)
12. Actor selects **Experience Requirements** (years, type)
13. Actor adds **Certifications Required** (optional)
14. Actor enters **Typical Rate/Range** (hourly/salary range, optional)
15. Actor saves job description as draft or publishes
16. System validates all required fields
17. System creates version 1.0 and stores job description
18. System displays success message with job description ID

### Post-conditions
1. Job description is created with status "Draft" or "Published"
2. Version 1.0 is recorded in version history
3. Job description is searchable in the system
4. Audit log captures creation event with timestamp and actor

### Alternative Flows

| ID | Scenario | Handling |
|----|----------|----------|
| AF-001 | Required field missing | System highlights missing field, prevents save, displays validation error |
| AF-002 | Duplicate title exists | System warns actor, suggests checking existing job description |
| AF-003 | User cancels creation | System discards unsaved data, returns to job description list |
| AF-004 | Session timeout during edit | System auto-saves draft, prompts to resume on re-login |

---

## Use Case 2: Edit/Update Job Description

| Field | Value |
|-------|-------|
| **Use Case ID** | JD-UC-002 |
| **Actor** | HR Manager, Department Head, Original Author |
| **Description** | Modify an existing job description, creating a new version in the process |

### Pre-conditions
1. Actor is authenticated and has permission to edit job descriptions
2. Job description exists and is in editable state
3. No pending approvals or locks on the job description

### Steps
1. Actor searches for or browses to target job description
2. Actor selects "Edit" action
3. System displays job description form pre-populated with current data
4. Actor modifies desired fields
5. System tracks all changes made
6. Actor adds edit summary/notes (e.g., "Updated required skills for 2026")
7. Actor saves changes
8. System validates modified fields
9. System increments version number (e.g., 1.0 → 1.1)
10. System stores new version with full change history
11. System displays success confirmation with version info

### Post-conditions
1. Job description updated with all modifications
2. New version created with incremented version number
3. Previous version retained in version history
4. Links to Recruitment, Performance, Teams, Compensation, and Training remain intact
5. Audit log captures edit event with before/after values

### Alternative Flows

| ID | Scenario | Handling |
|----|----------|----------|
| AF-001 | Concurrent edit conflict | System detects lock, notifies actor, offers to notify current editor or view read-only |
| AF-002 | Unauthorized field modification | System restricts editing to permitted fields based on role |
| AF-003 | No changes detected | System warns actor, offers to close without creating new version |
| AF-004 | Job description linked to active recruitment | System warns actor of potential posting impact, requires confirmation |

---

## Use Case 3: Use Job Description Template

| Field | Value |
|-------|-------|
| **Use Case ID** | JD-UC-003 |
| **Actor** | HR Manager, Department Head, HR Administrator |
| **Description** | Create a new job description by selecting and customizing a predefined template |

### Pre-conditions
1. Actor is authenticated and has permission to create job descriptions
2. At least one job description template exists in the system
3. Actor has access to view available templates

### Steps
1. Actor navigates to Job Descriptions section
2. Actor selects "Create from Template"
3. System displays available templates with previews
4. Actor reviews template details (structure, sections, sample content)
5. Actor selects desired template
6. System creates new job description form pre-populated with template data
7. Actor modifies/updates fields as needed (title, department, specifics)
8. Actor removes or adds sections as appropriate
9. Actor saves the new job description
10. System validates required fields
11. System creates version 1.0 with template reference stored
12. System displays success message

### Post-conditions
1. New job description created with template lineage recorded
2. Version 1.0 created
3. Template usage analytics updated (for reporting)
4. Job description functions as standard job description

### Alternative Flows

| ID | Scenario | Handling |
|----|----------|----------|
| AF-001 | No templates available | System displays message, offers to create job description from scratch |
| AF-002 | Template contains outdated references | System warns actor, suggests reviewing all fields before saving |
| AF-003 | Actor modifies template structure | System saves as regular job description, does not update original template |

---

## Use Case 4: Clone Existing Job Description

| Field | Value |
|-------|-------|
| **Use Case ID** | JD-UC-004 |
| **Actor** | HR Manager, Department Head, HR Administrator |
| **Description** | Duplicate an existing job description to create a new one with similar structure |

### Pre-conditions
1. Actor is authenticated and has permission to create job descriptions
2. Source job description exists and actor has view access
3. Actor has permission to clone (may be restricted by role)

### Steps
1. Actor locates source job description via search or browse
2. Actor selects "Clone" or "Duplicate" action
3. System displays clone confirmation dialog
4. Actor confirms cloning action
5. System creates copy with fields:
   - Title = "[Source Title] - Copy"
   - All content duplicated including responsibilities, skills, requirements
   - Grade reset to null (requires reassignment)
   - Links to external modules NOT copied (must be recreated)
   - Status set to "Draft"
   - Version initialized to 1.0
6. System displays cloned job description in edit mode
7. Actor updates title and other fields as needed
8. Actor saves cloned job description
9. System validates and stores new job description
10. System displays success message with new job description ID

### Post-conditions
1. New job description created with cloned content
2. Original job description unchanged
3. Clone source reference stored for audit purposes
4. All version history is new (no history from source)
5. External module links (Recruitment, Performance, etc.) are not copied

### Alternative Flows

| ID | Scenario | Handling |
|----|----------|----------|
| AF-001 | Source has inactive links | System warns actor that links will not be cloned |
| AF-002 | Actor cancels during clone | System discards clone, no new record created |
| AF-003 | Template exists for similar role | System suggests using template instead of clone |

---

## Use Case 5: View Version History

| Field | Value |
|-------|-------|
| **Use Case ID** | JD-UC-005 |
| **Actor** | HR Manager, Department Head, HR Administrator, Auditor |
| **Description** | View the complete version history of a job description with ability to compare versions |

### Pre-conditions
1. Actor is authenticated and has permission to view the job description
2. Job description has at least one version (always true after creation)
3. Actor has appropriate role for historical data access

### Steps
1. Actor locates target job description
2. Actor selects "Version History" or "View History"
3. System displays version history panel listing all versions:
   - Version number
   - Created date/time
   - Created by (actor)
   - Change summary
   - Status (Draft/Published)
4. Actor selects specific version to view
5. System displays full job description as of selected version
6. Actor may select "Compare Versions" to view diff
7. System highlights additions (green), deletions (red), modifications (yellow)
8. Actor can restore previous version if authorized
9. System creates new version if restore is executed

### Post-conditions
1. Actor has full visibility into job description evolution
2. Version comparison data available for audit
3. If restore executed, new version created with old content
4. Original versions remain intact in history

### Alternative Flows

| ID | Scenario | Handling |
|----|----------|----------|
| AF-001 | Only one version exists | System displays message "No previous versions available" |
| AF-002 | User lacks restore permission | System hides restore option, view-only access granted |
| AF-003 | Version contains sensitive data | System may mask certain fields based on user permissions |

---

## Use Case 6: Link to Recruitment (Create Job Posting)

| Field | Value |
|-------|-------|
| **Use Case ID** | JD-UC-006 |
| **Actor** | HR Manager, Recruiter |
| **Description** | Create a job posting in ksf_Recruitment using job description data |

### Pre-conditions
1. Actor is authenticated and has access to both JD and Recruitment modules
2. Job description is in "Published" status
3. Job description has all required fields completed
4. ksf_Recruitment module is active and accessible

### Steps
1. Actor opens job description
2. Actor selects "Create Job Posting" action
3. System displays job posting form with fields pre-populated from JD:
   - Position Title
   - Department
   - Job Summary (as job description)
   - Responsibilities
   - Required Skills
   - Education Requirements
   - Experience Requirements
4. Actor reviews and modifies posting content as needed
5. Actor adds recruitment-specific fields:
   - Posting date
   - Closing date
   - Location(s)
   - Employment type
   - Remote/Onsite designation
6. Actor selects compensation visibility (show/hide salary range)
7. Actor publishes job posting
8. System creates posting in ksf_Recruitment
9. System creates bidirectional link:
   - JD references recruitment posting ID
   - Posting references job description ID
10. System displays success with link to new posting

### Post-conditions
1. Job posting created in ksf_Recruitment
2. Job description updated with link to recruitment posting
3. Changes to JD can optionally trigger posting updates
4. Job posting status affects recruitment workflow

### Alternative Flows

| ID | Scenario | Handling |
|----|----------|----------|
| AF-001 | Job description in draft status | System prompts to publish JD before creating posting |
| AF-002 | Recruitment module unavailable | System displays error, suggests manual posting process |
| AF-003 | Multiple postings needed | System allows multiple postings linked to single JD |
| AF-004 | Job description edited after posting | System warns of potential posting inconsistency |

---

## Use Case 7: Link to Performance (Define Competencies)

| Field | Value |
|-------|-------|
| **Use Case ID** | JD-UC-007 |
| **Actor** | HR Manager, Performance Manager |
| **Description** | Associate competencies from ksf_Performance with a job description for assessment purposes |

### Pre-conditions
1. Actor is authenticated and has access to JD and Performance modules
2. Job description is in editable state
3. ksf_Performance competencies library is available

### Steps
1. Actor opens job description
2. Actor selects "Manage Competencies" or "Link Performance"
3. System displays competency management panel
4. System shows:
   - Currently linked competencies (if any)
   - Available competency library from ksf_Performance
5. Actor browses or searches competency library
6. Actor selects competencies to link:
   - Core competencies (required for role)
   - Technical competencies (job-specific skills)
   - Leadership competencies (if applicable)
7. For each competency, actor may set:
   - Required proficiency level (1-5)
   - Weight/importance for role
8. Actor saves competency associations
9. System validates selections
10. System creates links between JD and ksf_Performance competencies
11. System displays confirmation with linked competency count

### Post-conditions
1. Competencies linked to job description
2. Job description updated with competency reference
3. Competency profiles available for performance reviews
4. Changes to linked competencies reflected in related performance records

### Alternative Flows

| ID | Scenario | Handling |
|----|----------|----------|
| AF-001 | Competency not in library | System allows creation of new competency (if permitted) or flags for review |
| AF-002 | Job description has active performance reviews | System warns of impact on existing reviews |
| AF-003 | Competency proficiency level conflicts | System suggests review of assessment standards |

---

## Use Case 8: Link to Teams (Role Specifications)

| Field | Value |
|-------|-------|
| **Use Case ID** | JD-UC-008 |
| **Actor** | HR Manager, Team Lead, Department Head |
| **Description** | Associate a job description with a team or role in ksf_Teams module |

### Pre-conditions
1. Actor is authenticated and has access to JD and Teams modules
2. Teams exist in ksf_Teams system
3. Job description is in editable state

### Steps
1. Actor opens job description
2. Actor selects "Link to Team" or "Assign to Role"
3. System displays team/role selection panel
4. System shows:
   - Existing team assignments
   - Available teams from ksf_Teams
5. Actor searches or browses teams
6. Actor selects target team(s)
7. For each team link, actor may specify:
   - Role type (Primary, Secondary, Supporting)
   - Reporting relationship
   - Team size expectations
   - Collaboration requirements
8. Actor saves team associations
9. System validates team links
10. System creates bidirectional link:
    - JD references team ID(s)
    - Team record references job description
11. System displays confirmation

### Post-conditions
1. Job description linked to specified team(s)
2. Team role specifications updated with job reference
3. Org chart and reporting structures updated
4. Job description searchable by team

### Alternative Flows

| ID | Scenario | Handling |
|----|----------|----------|
| AF-001 | Team does not exist | System prompts to create new team or select existing |
| AF-002 | Multiple teams for single JD | System supports multiple team links with role weighting |
| AF-003 | Team already has primary JD | System warns of potential conflicts, allows override |

---

## Use Case 9: Link to Compensation (Grade Alignment)

| Field | Value |
|-------|-------|
| **Use Case ID** | JD-UC-009 |
| **Actor** | HR Manager, Compensation Analyst |
| **Description** | Align job description with salary grade from ksf_Compensation module |

### Pre-conditions
1. Actor is authenticated and has access to JD and Compensation modules
2. Salary grades exist in ksf_Compensation
3. Job description is in editable state

### Steps
1. Actor opens job description
2. Actor selects "Align Grade" or "Link Compensation"
3. System displays compensation alignment panel
4. System shows:
   - Current grade assignment (if any)
   - Available salary grades from ksf_Compensation
   - Grade criteria and requirements
5. Actor reviews grade criteria:
   - Education level requirements
   - Experience requirements
   - Skill complexity
   - Decision-making authority
   - Supervisory responsibilities
6. Actor selects appropriate grade for job description
7. System validates JD content against grade requirements
8. System may suggest grade adjustments based on:
   - Required skills complexity
   - Education requirements
   - Experience level
   - Responsibility scope
9. Actor confirms or adjusts grade selection
10. Actor saves grade alignment
11. System creates bidirectional link:
    - JD references salary grade ID
    - Grade references job description count
12. System displays confirmation with typical rate/range

### Post-conditions
1. Job description linked to salary grade
2. Typical rate/range populated from compensation data
3. Grade usage analytics updated
4. Job descriptions reportable by grade level

### Alternative Flows

| ID | Scenario | Handling |
|----|----------|----------|
| AF-001 | JD content conflicts with grade | System highlights discrepancies, suggests grade review |
| AF-002 | Grade level changed in Compensation | System flags affected job descriptions for review |
| AF-003 | No matching grade available | System suggests creating new grade or adjusting JD |

---

## Use Case 10: Link to Training (Required Training)

| Field | Value |
|-------|-------|
| **Use Case ID** | JD-UC-010 |
| **Actor** | HR Manager, Training Manager, Department Head |
| **Description** | Associate required and recommended training programs from ksf_Training with a job description |

### Pre-conditions
1. Actor is authenticated and has access to JD and Training modules
2. Training programs exist in ksf_Training
3. Job description is in editable state

### Steps
1. Actor opens job description
2. Actor selects "Manage Training" or "Link Training Programs"
3. System displays training management panel
4. System shows:
   - Currently linked training (if any)
   - Available training programs from ksf_Training
5. Actor browses or searches training library
6. Actor selects training to link:
   - **Required Training** (must complete before assuming role)
   - **Recommended Training** (optional, career development)
   - **Certification Programs** (if applicable)
7. For each training link, actor may specify:
   - Timing (before start, within 90 days, annual)
   - Renewal requirements
   - Priority level
8. Actor saves training associations
9. System validates training selections
10. System creates bidirectional link:
    - JD references training program IDs
    - Training programs reference job description count
11. System displays confirmation with training summary

### Post-conditions
1. Required training linked to job description
2. Training records available for onboarding workflows
3. Training gap analysis available for employees in role
4. Training compliance tracking enabled

### Alternative Flows

| ID | Scenario | Handling |
|----|----------|----------|
| AF-001 | Training program discontinued | System flags link, suggests alternative training |
| AF-002 | Training requirements change | System highlights affected job descriptions |
| AF-003 | New training needed not in library | System allows creation request or custom training entry |

---

## Appendix: Cross-Module Link Summary

| Use Case | Linked Module | Link Type | Direction |
|----------|--------------|-----------|-----------|
| UC-006 | ksf_Recruitment | Job Posting | Bidirectional |
| UC-007 | ksf_Performance | Competencies | Bidirectional |
| UC-008 | ksf_Teams | Role/Team | Bidirectional |
| UC-009 | ksf_Compensation | Salary Grade | Bidirectional |
| UC-010 | ksf_Training | Training Programs | Bidirectional |

---

## Actor Definitions

| Actor | Role | Permissions |
|-------|------|-------------|
| HR Manager | HR Department Lead | Full CRUD, all linking operations, template management |
| Department Head | Department Leadership | Create/Edit department JDs, link to teams, request training |
| HR Administrator | HR Support Staff | Create/Edit JDs, use templates, basic linking |
| Recruiter | Talent Acquisition | View JDs, create recruitment links |
| Performance Manager | Performance Admin | View JDs, manage competency links |
| Team Lead | Team Leadership | View JDs, suggest team links |
| Compensation Analyst | Compensation Specialist | View JDs, manage grade alignment |
| Training Manager | L&D Specialist | View JDs, manage training links |
| Auditor | Compliance/Audit | View-only access, version history |

---

## Version History

| Version | Date | Author | Changes |
|---------|------|--------|---------|
| 1.0.0 | 2026-05-13 | System | Initial use case document |
