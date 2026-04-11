"use client"

import { useRef, useEffect, useState } from "react"
import { ArrowRight, Mail, Sparkles } from "lucide-react"
import { Button } from "@/components/ui/button"

export function CTA() {
  const [isVisible, setIsVisible] = useState(false)
  const [email, setEmail] = useState("")
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

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault()
    // Handle newsletter signup
    console.log("Newsletter signup:", email)
    setEmail("")
  }

  return (
    <section ref={sectionRef} className="relative py-32 bg-[#0a0a0a] overflow-hidden">
      {/* Background Effects */}
      <div className="absolute inset-0 grid-pattern opacity-30" />
      
      {/* Animated Gradient Background */}
      <div className="absolute inset-0 overflow-hidden">
        <div className="absolute top-0 left-1/4 w-[600px] h-[600px] bg-gradient-to-r from-[#00ff88]/20 via-[#00ccff]/10 to-transparent rounded-full blur-[150px] animate-blob" />
        <div className="absolute bottom-0 right-1/4 w-[500px] h-[500px] bg-gradient-to-l from-[#00ccff]/20 via-[#00ff88]/10 to-transparent rounded-full blur-[150px] animate-blob delay-700" />
      </div>

      <div className="container mx-auto px-6 relative z-10">
        <div
          className={`max-w-4xl mx-auto text-center ${
            isVisible ? "animate-scale-in" : "opacity-0"
          }`}
        >
          {/* Badge */}
          <div className="inline-flex items-center gap-2 px-4 py-2 rounded-full glass mb-8">
            <Sparkles className="w-4 h-4 text-[#00ff88]" />
            <span className="text-sm text-white/80">Join Our Community</span>
          </div>

          {/* Heading */}
          <h2 className="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6">
            Work with <span className="gradient-text">TechBullion</span>
          </h2>

          {/* Description */}
          <p className="text-xl text-white/60 max-w-2xl mx-auto mb-12 leading-relaxed">
            Stay ahead of the curve with our premium newsletter. Get exclusive insights, 
            early access to breaking tech news, and expert analysis delivered to your inbox.
          </p>

          {/* Newsletter Form */}
          <form onSubmit={handleSubmit} className="max-w-md mx-auto mb-12">
            <div className="flex gap-3">
              <div className="relative flex-1">
                <Mail className="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-white/40" />
                <input
                  type="email"
                  value={email}
                  onChange={(e) => setEmail(e.target.value)}
                  placeholder="Enter your email"
                  className="w-full pl-12 pr-4 py-4 bg-[#1a1a1a] border border-[#333] rounded-xl text-white placeholder:text-white/40 focus:outline-none focus:border-[#00ff88]/50 transition-colors"
                  required
                />
              </div>
              <Button
                type="submit"
                className="bg-[#00ff88] text-[#0a0a0a] hover:bg-[#00ff88]/90 font-semibold px-6 py-4 h-auto transition-all hover:scale-105 hover:shadow-[0_0_40px_rgba(0,255,136,0.5)] group"
              >
                Subscribe
                <ArrowRight className="ml-2 w-4 h-4 transition-transform group-hover:translate-x-1" />
              </Button>
            </div>
          </form>

          {/* Trust Badges */}
          <div className="flex flex-wrap items-center justify-center gap-8 text-white/40 text-sm">
            <div className="flex items-center gap-2">
              <div className="w-2 h-2 rounded-full bg-[#00ff88]" />
              <span>No spam, ever</span>
            </div>
            <div className="flex items-center gap-2">
              <div className="w-2 h-2 rounded-full bg-[#00ff88]" />
              <span>Unsubscribe anytime</span>
            </div>
            <div className="flex items-center gap-2">
              <div className="w-2 h-2 rounded-full bg-[#00ff88]" />
              <span>Weekly digest</span>
            </div>
          </div>
        </div>
      </div>
    </section>
  )
}
