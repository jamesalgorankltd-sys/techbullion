"use client"

import { useState, useRef, useEffect } from "react"
import { Plus, Minus } from "lucide-react"

const faqs = [
  {
    question: "What topics does TechBullion cover?",
    answer:
      "TechBullion covers a wide range of technology topics including AI & Machine Learning, Blockchain & Web3, Cybersecurity, Cloud Computing, Startups & Innovation, Fintech, and emerging technologies. Our expert writers provide in-depth analysis, breaking news, and practical insights.",
  },
  {
    question: "How can I contribute to TechBullion?",
    answer:
      "We welcome contributions from industry experts and thought leaders. If you have valuable insights to share, visit our Contact page and submit your proposal. Our editorial team reviews all submissions and responds within 48 hours.",
  },
  {
    question: "Is TechBullion content free to access?",
    answer:
      "Yes, most of our content is free to access. We believe in democratizing tech knowledge. However, we also offer a premium newsletter with exclusive deep-dive reports, early access to breaking news, and direct access to our research team.",
  },
  {
    question: "How often is new content published?",
    answer:
      "We publish multiple articles daily, covering breaking news as it happens and in-depth analysis pieces weekly. Our team monitors the tech landscape 24/7 to ensure you never miss important developments.",
  },
  {
    question: "Can I advertise on TechBullion?",
    answer:
      "Yes, we offer various advertising and partnership opportunities for tech companies, startups, and brands looking to reach our engaged audience of tech professionals and enthusiasts. Contact our partnerships team for media kit and rates.",
  },
]

export function FAQ() {
  const [openIndex, setOpenIndex] = useState<number | null>(0)
  const [isVisible, setIsVisible] = useState(false)
  const sectionRef = useRef<HTMLElement>(null)

  useEffect(() => {
    const observer = new IntersectionObserver(
      ([entry]) => {
        if (entry.isIntersecting) {
          setIsVisible(true)
        }
      },
      { threshold: 0.1 }
    )

    if (sectionRef.current) {
      observer.observe(sectionRef.current)
    }

    return () => observer.disconnect()
  }, [])

  return (
    <section ref={sectionRef} className="relative py-32 bg-[#0a0a0a] overflow-hidden">
      {/* Background Effects */}
      <div className="absolute inset-0 grid-pattern opacity-30" />
      <div className="absolute top-1/4 right-0 w-80 h-80 bg-[#00ff88]/5 rounded-full blur-[120px]" />
      <div className="absolute bottom-1/4 left-0 w-64 h-64 bg-[#00ccff]/5 rounded-full blur-[100px]" />

      <div className="container mx-auto px-6 relative z-10">
        {/* Section Header */}
        <div className="text-center max-w-3xl mx-auto mb-16">
          <span className="inline-block text-[#00ff88] text-sm font-semibold tracking-wider uppercase mb-4">
            Got Questions?
          </span>
          <h2 className="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6">
            Frequently Asked <span className="gradient-text">Questions</span>
          </h2>
          <p className="text-white/60 text-lg leading-relaxed">
            Find answers to common questions about TechBullion and our content.
          </p>
        </div>

        {/* FAQ List */}
        <div className="max-w-3xl mx-auto space-y-4">
          {faqs.map((faq, index) => (
            <div
              key={index}
              className={`glass rounded-xl overflow-hidden transition-all duration-300 ${
                openIndex === index ? "border-[#00ff88]/30" : ""
              } ${isVisible ? "animate-slide-up" : "opacity-0"}`}
              style={{ animationDelay: `${index * 100}ms` }}
            >
              <button
                className="w-full flex items-center justify-between p-6 text-left"
                onClick={() => setOpenIndex(openIndex === index ? null : index)}
              >
                <span className="text-lg font-semibold text-white pr-8">
                  {faq.question}
                </span>
                <div
                  className={`flex-shrink-0 w-8 h-8 rounded-lg flex items-center justify-center transition-all ${
                    openIndex === index
                      ? "bg-[#00ff88] text-[#0a0a0a]"
                      : "bg-[#1a1a1a] text-white/60"
                  }`}
                >
                  {openIndex === index ? (
                    <Minus className="w-4 h-4" />
                  ) : (
                    <Plus className="w-4 h-4" />
                  )}
                </div>
              </button>
              <div
                className={`overflow-hidden transition-all duration-300 ${
                  openIndex === index ? "max-h-96" : "max-h-0"
                }`}
              >
                <div className="px-6 pb-6">
                  <p className="text-white/60 leading-relaxed">{faq.answer}</p>
                </div>
              </div>
            </div>
          ))}
        </div>
      </div>
    </section>
  )
}
