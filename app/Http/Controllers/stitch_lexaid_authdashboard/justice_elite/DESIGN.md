# Design System Specification: The Digital Magistrate

## 1. Overview & Creative North Star
The Creative North Star for this design system is **"The Digital Magistrate."** 

Unlike generic legal-tech platforms that feel like cold databases, this system is designed to feel like a high-end, private law chambers. We move beyond "standard" SaaS UI by embracing an **Editorial Authority**—a layout style that prioritizes legibility, intentional asymmetry, and "The Luxury of Space." 

We reject the rigid, boxed-in grid of the 2010s. Instead, we use layered surfaces and sophisticated typography to create a sense of trust and permanence. The goal is to make the user feel as though they are interacting with a prestigious institution, not just a software tool.

---

## 2. Colors & Tonal Depth
The palette is rooted in the `primary` (#002147), representing the deep navy of traditional legal authority. We pair this with `secondary` (#C5A021) and `tertiary` (#1A365D) to provide "Gold Leaf" accents that feel earned, not flashy.

### The "No-Line" Rule
To maintain a premium, high-end aesthetic, **designers are prohibited from using 1px solid borders for sectioning.** Traditional lines clutter the interface. Instead, boundaries must be defined through:
- **Background Color Shifts:** Use lighter tones for secondary content sitting on a base background.
- **Tonal Transitions:** Use soft, 5% opacity gradients to transition between content blocks.

### Surface Hierarchy & Nesting
Treat the UI as a series of physical layers—like stacked sheets of fine vellum.
- **Base Layer:** `neutral` (#F8F9FA)
- **Content Sections:** Use slightly darker neutral tones for content sections.
- **Primary Interaction Cards:** Use the lightest neutral tone to provide a "lifted" feel.
- **Active Navigation/Sidebars:** `primary` (#002147) for deep, authoritative grounding.

### The "Glass & Gradient" Rule
Floating elements (modals, dropdowns) should utilize **Glassmorphism**. Use the lightest neutral tone at 85% opacity with a `20px backdrop-blur`. For primary CTAs, apply a subtle linear gradient from `primary` to a darker shade of `primary` to add "visual soul" and prevent the flat look of entry-level platforms.

---

## 3. Typography: The Editorial Scale
We pair the intellectual rigor of a serif with the modern efficiency of a sans-serif.

- **The Voice (Serif - Newsreader):** Used for `display` and `headline` levels. This conveys "The Magistrate"—authoritative, timeless, and human.
- **The Engine (Sans-Serif - Manrope):** Used for `title`, `body`, and `label` levels. High legibility for legal documents and complex data.

| Role | Token | Font | Size | Intent |
| :--- | :--- | :--- | :--- | :--- |
| **Display** | `display-lg` | Newsreader | 3.5rem | High-impact landing pages. |
| **Headline**| `headline-md`| Newsreader | 1.75rem | Case titles and major section headers. |
| **Title**   | `title-lg`   | Manrope    | 1.375rem | Navigation and card titles. |
| **Body**    | `body-lg`    | Manrope    | 1rem | Legal text and long-form reading. |
| **Label**   | `label-md`   | Manrope    | 0.75rem | Input labels and metadata. |

---

## 4. Elevation & Depth
We eschew traditional drop shadows for **Tonal Layering**.

- **The Layering Principle:** Depth is achieved by stacking. Place a lighter neutral card on a slightly darker neutral background. The contrast in value provides a natural "lift" that feels integrated.
- **Ambient Shadows:** For floating elements (e.g., Modals), use extra-diffused shadows.
    - *Shadow Config:* `0 12px 32px rgba(0, 10, 30, 0.06)`. Note the tint: we use a hint of the `primary` color in the shadow to mimic natural light refraction.
- **The "Ghost Border" Fallback:** If a border is required for accessibility (e.g., in a high-density data table), use a very light neutral at **15% opacity**. Never use a 100% opaque border.

---

## 5. Components & Signature Patterns

### Buttons
- **Primary:** Gradient fill (`primary` to a darker shade of `primary`), white text, `subtle roundedness` (0.375rem) radius. High-contrast and substantial.
- **Secondary (Gold):** `secondary` background with `on-secondary` text. Use for critical legal actions (e.g., "Sign Document").
- **Tertiary:** No background. `primary` text with an underline that appears on hover.

### Input Fields
- **Modern Minimalist:** Use the lightest neutral background with a subtle light neutral ghost border. 
- **States:** On focus, the border transitions to `primary` (2px) and a subtle surface-tint glow.
- **Labels:** Always external. Use `label-md` in a darker neutral for absolute clarity.

### Cards & Lists: The "Invisible" Container
- **Forbid Dividers:** Do not use horizontal lines between list items. Use `normal spacing` (1.5rem) of vertical white space or alternating backgrounds (base neutral vs. slightly darker neutral) to define rows.
- **Refined Radius:** Use a moderately rounded value (0.75rem) for main dashboard cards to soften the "industrial" feel.

### Additional Legal-Tech Components
- **Case Status Badge:** Use `secondary` with `on-secondary` text. The gold hue suggests progress and high value.
- **Document Previewer:** A "Frosted Glass" overlay using a light neutral with backdrop blur to allow the user to maintain context of the underlying dashboard.

---

## 6. Do’s and Don’ts

### Do
- **Do** use asymmetrical layouts. A sidebar that is slightly wider or a headline that is offset creates an "editorial" rather than a "template" feel.
- **Do** prioritize white space. In legal tech, space is a sign of clarity and lack of chaos.
- **Do** use `secondary` (Gold) sparingly. It is a "reward" color, not a decorative one.

### Don’t
- **Don’t** use sharp 0px corners. Even a "highly professional" system needs the approachability of `subtle roundedness` (0.125rem) or `moderate roundedness` (0.375rem) radius.
- **Don’t** use pure black (#000). Use `primary` (#002147) for text to maintain the "Midnight Navy" brand depth.
- **Don’t** use traditional dividers. If the layout feels messy, increase the `spacing` scale rather than adding lines.