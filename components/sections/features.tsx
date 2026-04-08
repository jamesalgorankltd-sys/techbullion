"use client"

import { useRef, useEffect, useState } from "react"
import { Cpu, Zap, Shield, Globe, Layers, Rocket } from "lucide-react"

const features = [
  {
    icon: Cpu,
    title: "AI & Machine Learning",
    description: "Deep dive into artificial intelligence, neural networks, and the algorithms shaping our future.",
    color: "#00ff88",
  },
  {
    icon: Shield,
    title: "Cybersecurity",
    description: "Stay protected with the latest security insights, threats analysis, and protection strategies.",
    color: "#00ccff",
  },
  {
    icon: Globe,
    title: "Web3 & Blockchain",
    description: "Explore decentralized technologies, cryptocurrencies, and the future of digital ownership.",
    color: "#00ff88",
  },
  {
    icon: Zap,
    title: "Startups & Innovation",
    description: "Discover emerging startups, breakthrough technologies, and disruptive business models.",
    color: "#00ccff",
  },
  {
    icon: Layers,
    title: "Cloud Computing",
    description: "Master cloud architecture, serverless computing, and enterprise infrastructure solutions.",
    color: "#00ff88",
  },
  {
    icon: Rocket,
    title: "Future Tech",
    description: "Glimpse into quantum computing, space tech, and technologies that will define tomorrow.",
    color: "#00ccff",
  },
]

export function Features() {
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
      <div className="absolute top-1/2 left-0 w-96 h-96 bg-[#00ff88]/5 rounded-full blur-[120px]" />
      <div className="absolute bottom-0 right-0 w-80 h-80 bg-[#00ccff]/5 rounded-full blur-[100px]" />

      <div className="container mx-auto px-6 relative z-10">
        {/* Section Header */}
        <div className="text-center max-w-3xl mx-auto mb-20">
          <span className="inline-block text-[#00ff88] text-sm font-semibold tracking-wider uppercase mb-4">
            What We Cover
          </span>
          <h2 className="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 text-balance">
            TechBullion is Your
            <span className="gradient-text"> Digital Growth</span> Partner
          </h2>
          <p className="text-white/60 text-lg leading-relaxed">
            We bridge the gap between complex technology and practical understanding. 
            Our expert analysis helps you stay ahead in the rapidly evolving tech landscape.
          </p>
        </div>

        {/* Features Grid */}
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          {features.map((feature, index) => (
            <div
              key={index}
              className={`group relative p-8 rounded-2xl glass transition-all duration-500 hover:scale-[1.02] hover:border-[#00ff88]/30 ${
                isVisible ? "animate-slide-up opacity-100" : "opacity-0"
              }`}
              style={{ animationDelay: `${index * 100}ms` }}
            >
              {/* Icon */}
              <div
                className="w-14 h-14 rounded-xl flex items-center justify-center mb-6 transition-all duration-300 group-hover:scale-110"
                style={{ backgroundColor: `${feature.color}15` }}
              >
                <feature.icon
                  className="w-7 h-7 transition-colors"
                  style={{ color: feature.color }}
                />
              </div>

              {/* Content */}
              <h3 className="text-xl font-bold text-white mb-3 group-hover:text-[#00ff88] transition-colors">
                {feature.title}
              </h3>
              <p className="text-white/60 leading-relaxed">
                {feature.description}
              </p>

              {/* Hover Glow */}
              <div
                className="absolute inset-0 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"
                style={{
                  background: `radial-gradient(circle at center, ${feature.color}10 0%, transparent 70%)`,
                }}
              />
            </div>
          ))}
        </div>
      </div>
    </section>
  )
}
