"use client"

import { useRef, useEffect, useState } from "react"
import Image from "next/image"
import { Header } from "@/components/layout/header"
import { Footer } from "@/components/layout/footer"
import { Target, Users, Lightbulb, Award, ArrowRight, Linkedin, Twitter } from "lucide-react"
import { Button } from "@/components/ui/button"
import Link from "next/link"

const stats = [
  { value: "10K+", label: "Articles Published" },
  { value: "500K+", label: "Monthly Readers" },
  { value: "50+", label: "Expert Writers" },
  { value: "8+", label: "Years Experience" },
]

const values = [
  {
    icon: Target,
    title: "Accuracy First",
    description: "We verify every fact and source, ensuring our readers get reliable, trustworthy information.",
  },
  {
    icon: Lightbulb,
    title: "Innovation Focus",
    description: "We cover emerging technologies and trends before they become mainstream.",
  },
  {
    icon: Users,
    title: "Community Driven",
    description: "Our readers shape our coverage. We listen, engage, and deliver what matters most.",
  },
  {
    icon: Award,
    title: "Excellence Always",
    description: "From writing to design, we maintain the highest standards in everything we do.",
  },
]

const team = [
  {
    name: "Alex Thompson",
    role: "Founder & Editor-in-Chief",
    image: "https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&h=400&fit=crop",
    bio: "Former tech journalist with 15+ years covering Silicon Valley.",
  },
  {
    name: "Sarah Chen",
    role: "AI Research Editor",
    image: "https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=400&h=400&fit=crop",
    bio: "PhD in Machine Learning, previously at Google DeepMind.",
  },
  {
    name: "Michael Park",
    role: "Senior Tech Correspondent",
    image: "https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=400&h=400&fit=crop",
    bio: "Specializes in blockchain and fintech coverage.",
  },
  {
    name: "Emma Wilson",
    role: "Cybersecurity Analyst",
    image: "https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=400&h=400&fit=crop",
    bio: "Former security consultant for Fortune 500 companies.",
  },
]

export default function AboutPage() {
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
    <main className="min-h-screen bg-[#0a0a0a]">
      <Header />

      {/* Hero Section */}
      <section className="relative pt-32 pb-20 overflow-hidden">
        <div className="absolute inset-0 grid-pattern opacity-30" />
        <div className="absolute top-1/4 left-1/4 w-96 h-96 bg-[#00ff88]/10 rounded-full blur-[120px]" />
        <div className="absolute bottom-1/4 right-1/4 w-80 h-80 bg-[#00ccff]/10 rounded-full blur-[100px]" />

        <div className="container mx-auto px-6 relative z-10">
          <div className="max-w-4xl mx-auto text-center">
            <span className="inline-block text-[#00ff88] text-sm font-semibold tracking-wider uppercase mb-4">
              About Us
            </span>
            <h1 className="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6">
              We Are <span className="gradient-text">TechBullion</span>
            </h1>
            <p className="text-white/60 text-lg md:text-xl leading-relaxed max-w-2xl mx-auto">
              Your trusted source for cutting-edge technology insights, in-depth analysis, 
              and the latest news from the world of innovation.
            </p>
          </div>
        </div>
      </section>

      {/* Stats Section */}
      <section className="py-16 border-y border-[#222]">
        <div className="container mx-auto px-6">
          <div className="grid grid-cols-2 md:grid-cols-4 gap-8">
            {stats.map((stat, index) => (
              <div key={index} className="text-center">
                <div className="text-3xl md:text-4xl font-bold text-white mb-2">{stat.value}</div>
                <div className="text-white/50 text-sm">{stat.label}</div>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* Mission Section */}
      <section ref={sectionRef} className="py-32 relative overflow-hidden">
        <div className="absolute inset-0 grid-pattern opacity-30" />

        <div className="container mx-auto px-6 relative z-10">
          <div className="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div
              className={`${isVisible ? "animate-slide-up" : "opacity-0"}`}
            >
              <span className="inline-block text-[#00ff88] text-sm font-semibold tracking-wider uppercase mb-4">
                Our Mission
              </span>
              <h2 className="text-3xl md:text-4xl font-bold text-white mb-6">
                Democratizing Technology Knowledge
              </h2>
              <p className="text-white/60 text-lg leading-relaxed mb-6">
                At TechBullion, we believe everyone deserves access to quality technology insights. 
                Our mission is to bridge the gap between complex technological concepts and practical 
                understanding, empowering our readers to navigate the digital future with confidence.
              </p>
              <p className="text-white/60 text-lg leading-relaxed mb-8">
                Founded in 2018, we&apos;ve grown from a small tech blog to one of the most trusted 
                sources for technology news and analysis. Our team of expert writers, researchers, 
                and analysts work tirelessly to bring you accurate, timely, and actionable insights.
              </p>
              <Link href="/contact">
                <Button
                  className="bg-[#00ff88] text-[#0a0a0a] hover:bg-[#00ff88]/90 font-semibold px-6 transition-all hover:scale-105 hover:shadow-[0_0_30px_rgba(0,255,136,0.5)] group"
                >
                  Get in Touch
                  <ArrowRight className="ml-2 w-4 h-4 transition-transform group-hover:translate-x-1" />
                </Button>
              </Link>
            </div>

            <div
              className={`relative ${isVisible ? "animate-slide-up delay-200" : "opacity-0"}`}
            >
              <div className="relative aspect-square rounded-2xl overflow-hidden">
                <Image
                  src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=800&h=800&fit=crop"
                  alt="TechBullion Team"
                  fill
                  className="object-cover"
                />
                <div className="absolute inset-0 bg-gradient-to-t from-[#0a0a0a]/80 via-transparent to-transparent" />
              </div>
              {/* Decorative Elements */}
              <div className="absolute -top-4 -right-4 w-24 h-24 border-2 border-[#00ff88]/30 rounded-2xl" />
              <div className="absolute -bottom-4 -left-4 w-32 h-32 border-2 border-[#00ccff]/20 rounded-2xl" />
            </div>
          </div>
        </div>
      </section>

      {/* Values Section */}
      <section className="py-32 bg-[#111] relative overflow-hidden">
        <div className="absolute inset-0 grid-pattern opacity-20" />

        <div className="container mx-auto px-6 relative z-10">
          <div className="text-center max-w-3xl mx-auto mb-16">
            <span className="inline-block text-[#00ff88] text-sm font-semibold tracking-wider uppercase mb-4">
              Our Values
            </span>
            <h2 className="text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-6">
              What Drives <span className="gradient-text">Our Work</span>
            </h2>
          </div>

          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            {values.map((value, index) => (
              <div
                key={index}
                className="group p-8 glass rounded-2xl transition-all duration-500 hover:scale-[1.02] hover:border-[#00ff88]/30"
              >
                <div className="w-14 h-14 rounded-xl bg-[#00ff88]/10 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                  <value.icon className="w-7 h-7 text-[#00ff88]" />
                </div>
                <h3 className="text-xl font-bold text-white mb-3">{value.title}</h3>
                <p className="text-white/60 leading-relaxed">{value.description}</p>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* Team Section */}
      <section className="py-32 relative overflow-hidden">
        <div className="absolute inset-0 grid-pattern opacity-30" />
        <div className="absolute top-1/4 right-0 w-96 h-96 bg-[#00ff88]/5 rounded-full blur-[120px]" />

        <div className="container mx-auto px-6 relative z-10">
          <div className="text-center max-w-3xl mx-auto mb-16">
            <span className="inline-block text-[#00ff88] text-sm font-semibold tracking-wider uppercase mb-4">
              Our Team
            </span>
            <h2 className="text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-6">
              Meet the <span className="gradient-text">Experts</span>
            </h2>
            <p className="text-white/60 text-lg leading-relaxed">
              Our team of industry experts brings decades of combined experience in technology journalism, 
              research, and analysis.
            </p>
          </div>

          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            {team.map((member, index) => (
              <div
                key={index}
                className="group text-center"
              >
                <div className="relative mb-6 mx-auto w-48 h-48 rounded-2xl overflow-hidden">
                  <Image
                    src={member.image}
                    alt={member.name}
                    fill
                    className="object-cover transition-transform duration-500 group-hover:scale-110"
                  />
                  <div className="absolute inset-0 bg-gradient-to-t from-[#0a0a0a]/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity" />
                  
                  {/* Social Links */}
                  <div className="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                    <button className="w-8 h-8 rounded-lg bg-[#1a1a1a]/80 flex items-center justify-center text-white hover:text-[#00ff88] transition-colors">
                      <Twitter className="w-4 h-4" />
                    </button>
                    <button className="w-8 h-8 rounded-lg bg-[#1a1a1a]/80 flex items-center justify-center text-white hover:text-[#00ff88] transition-colors">
                      <Linkedin className="w-4 h-4" />
                    </button>
                  </div>
                </div>
                <h3 className="text-lg font-bold text-white mb-1">{member.name}</h3>
                <p className="text-[#00ff88] text-sm mb-2">{member.role}</p>
                <p className="text-white/50 text-sm">{member.bio}</p>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* CTA Section */}
      <section className="py-20 bg-[#111] border-y border-[#222]">
        <div className="container mx-auto px-6">
          <div className="max-w-3xl mx-auto text-center">
            <h2 className="text-3xl md:text-4xl font-bold text-white mb-6">
              Want to Join Our Team?
            </h2>
            <p className="text-white/60 text-lg mb-8">
              We&apos;re always looking for talented writers, researchers, and tech enthusiasts 
              to join our growing team.
            </p>
            <Link href="/contact">
              <Button
                size="lg"
                className="bg-[#00ff88] text-[#0a0a0a] hover:bg-[#00ff88]/90 font-semibold px-8 transition-all hover:scale-105 hover:shadow-[0_0_40px_rgba(0,255,136,0.5)] group"
              >
                Contact Us
                <ArrowRight className="ml-2 w-5 h-5 transition-transform group-hover:translate-x-1" />
              </Button>
            </Link>
          </div>
        </div>
      </section>

      <Footer />
    </main>
  )
}
